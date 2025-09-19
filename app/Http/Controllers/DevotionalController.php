<?php

namespace App\Http\Controllers;

use App\Http\Requests\Devotional\CreateDevotionalRequest;
use App\Http\Requests\Devotional\UpdateDevotionalRequest;
use App\Services\DevotionalService;
use DataTables;
use Illuminate\Support\Str;
use App\Models\Devotional;

class DevotionalController extends Controller
{
  protected $service;

  public function __construct(DevotionalService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    return view('content.apps.devotional.list');
  }

  public function getAll()
  {
    $devotionals = $this->service->getAllDevotionals();

    return DataTables::of($devotionals)
      ->addColumn('actions', function ($row) {
        $encryptedId = encrypt($row->id);

        $edit = "<a href='" . route('devotional.edit', $encryptedId) . "' class='btn btn-sm text-secondary'><i data-feather='edit'></i></a>";
        $delete = "<a href='" . route('devotional.delete', $encryptedId) . "' class='btn btn-sm text-danger confirm-delete'><i data-feather='trash-2'></i></a>";

        return $edit . ' ' . $delete;
      })
      ->addColumn('status', function ($row) {
        return $row->status
          ? '<span class="badge bg-label-success" style="color: #000 !important;">Active</span>'
          : '<span class="badge bg-label-danger">Inactive</span>';
      })
      ->rawColumns(['actions', 'status'])
      ->make(true);
  }

  public function create()
  {
    $devotional = null;
    $page_data = [
      'page_title' => 'Add Devotional',
      'form_title' => 'Create New Devotional'
    ];
    return view('content.apps.devotional.create-edit', compact('page_data', 'devotional'));
  }

  public function store(CreateDevotionalRequest $request)
  {
    $data = $request->validated();

    $data['encrypted_id'] = encrypt(now()->timestamp);
    $data['title'] = $request->title;
    $data['slug_url'] = $this->generateUniqueSlug($request->title);
    $data['description'] = $request->description;
    $data['long_description'] = $request->long_description;
    $data['page'] = $request->page;
    $data['status'] = $request->has('status') ? 1 : 0;

    $this->service->createDevotional($data);

    return redirect()->route('devotional.list')->with('success', 'Devotional added successfully');
  }

  public function edit($encrypted_id)
  {
    $id = decrypt($encrypted_id);
    $devotional = $this->service->getDevotional($id);

    $page_data = [
      'page_title' => 'Edit Devotional',
      'form_title' => 'Edit Devotional'
    ];

    return view('content.apps.devotional.create-edit', compact('page_data', 'devotional'));
  }

  public function update(UpdateDevotionalRequest $request, $encrypted_id)
  {

    $id = decrypt($encrypted_id);
    $data = $request->validated();

    $data['title'] = $request->title;
    $data['slug_url'] = $this->generateUniqueSlug($request->title, $id);
    $data['description'] = $request->description;
    $data['long_description'] = $request->long_description;
    $data['page'] = $request->page;
    $data['status'] = $request->has('status') ? 1 : 0;

    $this->service->updateDevotional($id, $data);

    return redirect()->route('devotional.list')->with('success', 'Devotional updated successfully');
  }

  public function destroy($encrypted_id)
  {
    $id = decrypt($encrypted_id);
    $this->service->deleteDevotional($id);

    return redirect()->route('devotional.list')->with('success', 'Devotional deleted successfully');
  }

  private function generateUniqueSlug($title, $id = null)
  {
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $counter = 1;

    while (
      Devotional::where('slug_url', $slug)
        ->when($id, fn($query) => $query->where('id', '!=', $id))
        ->exists()
    ) {
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }
}
