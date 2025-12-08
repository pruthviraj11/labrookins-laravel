<?php
namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
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
     $categories = Category::orderBy('title','ASC')->get();
    return view('content/apps/products.list',compact('categories'));
  }

  public function getAll(Request $request)
  {
    // dd(Product::count());
    if ($request->ajax()) 
      {
          //$query = $this->service->getAll();
          //$query = Product::with('category')->orderBy('product_name','ASC')->get();
         
          $query = Product::with('category');
           // Filter: Category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter: Product Type
        if ($request->product_type) {
            $query->where('product_digital', $request->product_type);
        }

        // Filter: Price
        if ($request->price) {
            $query->where('product_price', 'LIKE', "%{$request->price}%");
        }

        // Filter: Status
        if (!is_null($request->status) && $request->status !== "") {
             $query->where('status', $request->status);
        }
        $query->orderBy('product_name', 'ASC');

      return datatables()->of($query)
        ->addColumn('checkbox', function ($row) {
        return '<input type="checkbox" class="product_row_checkbox" value="' . $row->id . '">';
    })
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
                    <a href="' . $editUrl . '" class="btn btn-sm me-1 text-secondary">
                        <i class="ti ti-edit"></i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;"
                          onsubmit="return confirm(\'Are you sure?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm text-danger">
                                <i class="ti ti-trash"></i>
                        </button>
                    </form>
                ';
        })
        ->rawColumns(['checkbox','status', 'product_type', 'actions'])
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
    $data['status'] = $request->has('status') ? 1 : 0;

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
    $data['status'] = $request->has('status') ? 1 : 0;

    if ($request->hasFile('product_image')) {
      $data['product_image'] = $request->file('product_image')->store('products', 'public');
    }
    if ($request->hasFile('download_document')) {
      $data['download_document'] = $request->file('download_document')->store('products/docs', 'public');
      $data['product_digital'] = 'yes';
    } else {
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

  /*--- Delete Multiple Products ----*/
public function deleteMultiProduct(Request $request)
{
    $ids = $request->ids;
   
    Product::whereIn('id', $request->ids)->delete();

    return response()->json([
        'status' => true, 
        'message' => 'Deleted successfully'
    ]);
} 
}

