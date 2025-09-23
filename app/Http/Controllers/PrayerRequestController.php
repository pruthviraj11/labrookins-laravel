<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PrayerRequestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PrayerRequest::select('*');
            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    $viewBtn = '<a href="'.route('prayer_requests.show', encrypt($row->id)).'" class="btn btn-sm " data-bs-toggle="tooltip" title="View"><i data-feather="eye" class = "text-secondary"></i></a>';
                    $deleteBtn = '<a href="'.route('prayer_requests.delete', $row->id).'" class="btn btn-sm  confirm-delete" data-bs-toggle="tooltip" title="Delete"><i data-feather="trash-2" class="text-danger"></i></a>';
                    return $viewBtn . ' ' . $deleteBtn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('content/apps/prayer_requests.list');
    }

    public function show($id)
    {
      $id = decrypt($id);
        $request = PrayerRequest::findOrFail($id);
        return view('content/apps/prayer_requests.view', compact('request'));
    }

    public function delete($id)
    {
        $request = PrayerRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('prayer_requests.index')->with('success', 'Prayer request deleted successfully.');
    }
}
