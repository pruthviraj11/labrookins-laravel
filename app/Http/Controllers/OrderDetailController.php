<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
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
                        <button type="submit" class="btn text-danger btn-sm"
                            onclick="return confirm(\'Are you sure?\')"><i class="ti ti-trash"></i></button>
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
    return view('content/apps/orders.view', compact('order'));
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
}
