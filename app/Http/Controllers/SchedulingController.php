<?php
namespace App\Http\Controllers;

use App\Models\Scheduling;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SchedulingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Scheduling::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('content/apps/schedulings.list');
    }
}

