<?php
namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
  protected $service;

  public function __construct(ProductService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    return view('content/apps/products.list');
  }

  public function getAll(Request $request)
  {
    if ($request->ajax()) {
      return datatables()->of($this->service->getAll())
        ->addColumn('category', fn($row) => $row->category?->title ?? '-')
        ->addColumn('status', fn($row) => $row->status ? '<span class="badge bg-label-success">Active</span>' : '<span class="badge bg-label-danger">Inactive</span>')
           ->addColumn('product_type', function ($row) {
                if ($row->product_digital === 'yes') {
                    return '<span class="badge text-success">Digital</span>';
                }
                return '<span class="badge text-danger">Physical</span>';
            })
        ->addColumn('actions', function ($row) {
          $editUrl = route('store.products.edit', encrypt($row->id));
          $deleteUrl = route('store.products.destroy', encrypt($row->id));

          return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">
                        <i data-feather="edit">Edit</i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;"
                          onsubmit="return confirm(\'Are you sure?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i data-feather="trash-2">delete</i>
                        </button>
                    </form>
                ';
        })
        ->rawColumns(['status','product_type','actions'])
        ->make(true);
    }
  }

  public function create()
  {
    $categories = Category::where('is_deleted', 'no')->get();
    return view('content/apps/products.create-edit', compact('categories'));
  }

  public function store(StoreProductRequest $request)
  {
    // dd($request->all());
    $data = $request->validated();
    $data['category_id'] = $request->category_id;
    $data['product_name'] = $request->product_name;
    $data['product_description'] = $request->product_description;
    $data['product_price'] = $request->product_price;
    $data['product_discount_price'] = $request->product_discount_price;

    if ($request->hasFile('product_image')) {
      $data['product_image'] = $request->file('product_image')->store('products', 'public');
    }
    if ($request->hasFile('download_document')) {
      $data['download_document'] = $request->file('download_document')->store('products/docs', 'public');
       $data['product_digital'] = 'yes';
    } else {
        $data['product_digital'] = 'no'; // default
    }

    $this->service->store($data);

    return redirect()->route('store.products.list')->with('success', 'Product created successfully.');
  }

  public function edit($encrypted_id)
  {
    $product = $this->service->find($encrypted_id);
    $categories = Category::where('is_deleted', 'no')->get();
    // dd($product,$categories);
    return view('content/apps/products.create-edit', compact('product', 'categories'));
  }

  public function update(UpdateProductRequest $request, $encrypted_id)
  {
    // dd($encrypted_id,'hii');
    $data = $request->validated();
    $data['category_id'] = $request->category_id;
    $data['product_name'] = $request->product_name;
    $data['product_description'] = $request->product_description;
    $data['product_price'] = $request->product_price;
    $data['product_discount_price'] = $request->product_discount_price;

    if ($request->hasFile('product_image')) {
      $data['product_image'] = $request->file('product_image')->store('products', 'public');
    }
    if ($request->hasFile('download_document')) {
      $data['download_document'] = $request->file('download_document')->store('products/docs', 'public');
        $data['product_digital'] = 'yes';
    }else {
        $data['product_digital'] = 'no'; // default
    }

    $this->service->update($encrypted_id, $data);

    return redirect()->route('store.products.list')->with('success', 'Product updated successfully.');
  }

  public function destroy($encrypted_id)
  {
    // dd($encrypted_id);
    $this->service->delete($encrypted_id);
    return response()->json(['success' => 'Product deleted successfully.']);
  }
}

