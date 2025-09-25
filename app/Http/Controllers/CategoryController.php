<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Support\Str;
use DataTables;

class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    private function generateUniqueSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (\App\Models\Category::where('slug_url', $slug)
            ->when($id, fn($query) => $query->where('id', '!=', $id))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function index()
    {
        return view('content.apps.categories.list');
    }

    public function getAll()
    {
        $categories = $this->service->getAllCategories();
        return DataTables::of($categories)
            ->addColumn('status', function ($row) {

                return $row->is_active == 'active'
                    ? '<span class="badge bg-label-success">Active</span>'
                    : '<span class="badge bg-label-danger">Inactive</span>';
            })
            ->addColumn('actions', function ($row) {
                $encryptedId = encrypt($row->id);
                $edit = "<a href='".route('categories.edit', $encryptedId)."' class='btn-sm text-secondary' data-bs-toggle='tooltip' title='Edit'><i data-feather='edit'></i></a>";
                $delete = "<a href='".route('categories.delete', $encryptedId)."' class='btn-sm text-danger confirm-delete' data-bs-toggle='tooltip' title='Delete'><i data-feather='trash-2'></i></a>";
                return $edit . ' ' . $delete;
            })
            ->rawColumns(['status','actions'])
            ->make(true);
    }

    public function create()
    {
        return view('content.apps.categories.create-edit', ['category' => null, 'page_data' => ['page_title' => 'Add Category', 'form_title' => 'Add New Category']]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $data['encrypted_id'] = encrypt(now()->timestamp);
        $data['slug_url'] = $this->generateUniqueSlug($request->title);
        $data['is_active'] = $request->has('is_active') ? 'active' : 'inactive';
        $data['is_deleted'] = 'no';

        $this->service->createCategory($data);

        return redirect()->route('categories.list')->with('success','Category added successfully');
    }

    public function edit($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $category = $this->service->getCategory($id);
        return view('content.apps.categories.create-edit', ['category' => $category, 'page_data' => ['page_title' => 'Edit Category', 'form_title' => 'Edit Category']]);
    }

    public function update(UpdateCategoryRequest $request, $encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $data = $request->validated();
        $data['slug_url'] = $this->generateUniqueSlug($request->title, $id);
        $data['is_active'] = $request->has('is_active') ? 'active' : 'inactive';

        $this->service->updateCategory($id, $data);

        return redirect()->route('categories.list')->with('success','Category updated successfully');
    }

    public function destroy($encrypted_id)
    {
        $id = decrypt($encrypted_id);
        $this->service->deleteCategory($id);
        return redirect()->route('categories.list')->with('success','Category deleted successfully');
    }
}
