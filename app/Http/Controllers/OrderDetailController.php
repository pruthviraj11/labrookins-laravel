<?php

namespace App\Http\Controllers;

use App\Services\OrderDetailService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
        $orders = \App\Models\OrderDetail::select('*')->orderBy('date_and_time', 'desc');
        return DataTables::of($orders)
            ->addColumn('name', function ($row) {
                return $row->fname . ' ' . $row->lname;
            })
            ->addColumn('address', function ($row) {
                return $row->street_address1 . ', ' . $row->city . ', ' . $row->state;
            })
            ->addColumn('actions', function ($row) {
                $viewUrl = route('orders.show', $row->id);
                $deleteUrl = route('orders.destroy', $row->id);
                return '
                    <a href="'.$viewUrl.'" class="btn btn-info btn-sm">View</a>
                    <form action="'.$deleteUrl.'" method="POST" style="display:inline-block;">
                        '.csrf_field().method_field("DELETE").'
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>';
            })
            ->rawColumns(['actions'])
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
}
