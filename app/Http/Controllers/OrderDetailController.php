<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\TempAddcart;
use App\Services\OrderDetailService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
class OrderDetailController extends Controller
{
  protected $service;

  public function __construct(OrderDetailService $service)
  {
    $this->service = $service;
  }

  public function index(Request $request)
  {
    // dd($request->all());
    if ($request->ajax()) {
      $orders = OrderDetail::select('*')->orderBy('date_and_time', 'desc');
      return DataTables::of($orders)
        ->addColumn('name', function ($row) {
          return $row->fname . ' ' . $row->lname;
        })
        ->addColumn('address', function ($row) {
          return $row->street_address1 . ', ' . $row->city . ', ' . $row->state;
        })
        ->addColumn('email_send', function ($row) {
          $url = route('orders.sendMail', $row->id);
          return '<button type="button" class="btn btn-primary btn-sm send-mail-btn" style="border-radius:50px"
                    data-url="' . $url . '" data-id="' . $row->id . '">
                    Send Email
                </button>';
        })
        ->addColumn('actions', function ($row) {
          $viewUrl = route('orders.show', $row->id);
          $deleteUrl = route('orders.destroy', $row->id);
          return '
                    <a href="' . $viewUrl . '" class="btn text-secondary btn-sm mb-1"><i class="ti ti-eye"></i></a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . method_field("DELETE") . '
                      <button type="button" class="btn text-danger btn-sm delete-btn">
        <i class="ti ti-trash"></i>
    </button>
                    </form>';
        })
        ->rawColumns(['actions', 'email_send'])
        ->make(true);
    }

    return view('content/apps/orders.list');
  }

  public function show($id)
  {
    $order = $this->service->find($id);
    // dd($order->guest_id);
    $product_data = TempAddcart::select('temp_addcart.*', 'products.product_name', 'products.product_description', 'products.product_image', 'products.product_digital')
    ->leftJoin('products', 'temp_addcart.product_id', '=', 'products.id')
    ->where('temp_addcart.guest_id', $order->guest_id)->get();
    // dd($product_data,'Hii',$order);
    // dd($product_data);
    // $product_details =
    return view('content/apps/orders.view', compact('order','product_data'));
  }

  public function destroy($id)
  {
    $this->service->delete($id);
    return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
  }

  public function export()
  {
    return $this->service->export();
  }

  public function sendMail($id)
  {
    $order = OrderDetail::findOrFail($id);

    // Send mail
    // dd($order->email);
    Mail::to($order->email)->send(new OrderMail($order));

    return response()->json(['success' => true, 'message' => 'Mail sent successfully!']);
  }

  public function order_status(Request $request, $id)
  {
    // dd($request->all());
    $order = OrderDetail::findOrFail($id);
$order->delivered = $request->input('delivery_status');
    $order->save();

    return redirect()->route('orders.show', $id)->with('success', 'Order status updated successfully.');
  }
}
