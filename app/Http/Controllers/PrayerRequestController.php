<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Mail\PrayerRequestNotification;
use Illuminate\Support\Facades\Mail;
class PrayerRequestController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = PrayerRequest::select('*');
      return DataTables::of($data)
        ->addColumn('actions', function ($row) {
          $viewBtn = '<a href="' . route('prayer_requests.show', encrypt($row->id)) . '" class=" btn-sm " data-bs-toggle="tooltip" title="View"><i data-feather="eye" class = "text-secondary"></i></a>';
          $deleteBtn = '<a href="' . route('prayer_requests.delete', $row->id) . '" class=" btn-sm  confirm-delete" data-bs-toggle="tooltip" title="Delete"><i data-feather="trash-2" class="text-danger"></i></a>';
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


  public function store(Request $request)
  {
    $request->validate([
      'category' => 'required|string|max:20',
      'praysubject' => 'required|string|max:150',
      'prayer_for' => 'required|string|max:100',
      'prayer_for_is_member' => 'required|string|max:100',
      'requested_by' => 'required|string|max:100',
      'phone_no_type_one' => 'required|string|max:30',
      'phone_no_one' => 'required|string|max:20',
      'your_email' => 'required|email|max:50',
      'requester_is_member' => 'required|string|max:20',
      'message' => 'required|string|max:250',
    ]);

    $prayerRequest = PrayerRequest::create([
      'category' => $request->category,
      'subject' => $request->praysubject,
      'need_prayer_name' => $request->prayer_for,
      'prayer_church_member' => $request->prayer_for_is_member,
      'requested_name' => $request->requested_by,
      'phone_no_type_one' => $request->phone_no_type_one,
      'mobile_one' => $request->phone_no_one,
      'phone_no_type_two' => $request->phone_no_type_two ?? null,
      'mobile_two' => $request->phone_no_two ?? null,
      'email' => $request->your_email,
      'requested_church_member' => $request->requester_is_member,
      'message' => $request->message,
      'status' => 1,
    ]);

    $settings = Setting::first();
    Mail::to($settings->prayer_request_email)->send(new PrayerRequestNotification($prayerRequest));

    return redirect()->back()->with('success', 'Your prayer request has been submitted successfully!');
  }

}
