<?php
namespace App\Http\Controllers;

use App\Mail\SchedulingNotification;
use App\Models\Scheduling;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
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

  public function store(Request $request)
  {
    $data = $request->validate([
      'yourname' => 'required|string|max:100',
      'yourposition' => 'nullable|string|max:100',
      'ministryname' => 'nullable|string|max:150',
      'pastorname' => 'nullable|string|max:100',
      'address' => 'nullable|string|max:250',
      'city' => 'nullable|string|max:100',
      'state' => 'nullable|string|max:100',
      'zip' => 'nullable|string|max:100',
      'email' => 'required|email|max:100',
      'officephone' => 'nullable|string|max:30',
      'homephone' => 'nullable|string|max:30',
      'mobilephone' => 'nullable|string|max:30',
      'ministryaffiliation' => 'nullable|string|max:250',
      'nameofevent' => 'nullable|string|max:150',
      'typeofevent' => 'nullable|string|max:100',
      'theme' => 'nullable|string|max:100',
      'dateofevent' => 'nullable|date',
      'alternatedate' => 'nullable|date',
      'timeofservice' => 'nullable|string|max:100',
      'locationofevent' => 'nullable|string|max:250',
      'scomment' => 'nullable|string|max:200',
      'smanydays' => 'nullable|string|max:50',
      'sreachyou' => 'nullable|string|max:150',
    ]);

    $scheduling = Scheduling::create([
      'name' => $data['yourname'],
      'position' => $data['yourposition'] ?? null,
      'ministry_name' => $data['ministryname'] ?? null,
      'pastor_name' => $data['pastorname'] ?? null,
      'address' => $data['address'] ?? null,
      'city' => $data['city'] ?? null,
      'state' => $data['state'] ?? null,
      'zip' => $data['zip'] ?? null,
      'email' => $data['email'],
      'office_phone' => $data['officephone'] ?? null,
      'home_phone' => $data['homephone'] ?? null,
      'mobile_phone' => $data['mobilephone'] ?? null,
      'ministry_affilation' => $data['ministryaffiliation'] ?? null,
      'event_name' => $data['nameofevent'] ?? null,
      'event_type' => $data['typeofevent'] ?? null,
      'theam' => $data['theme'] ?? null,
      'event_date' => $data['dateofevent'] ?? null,
      'event_alternate_date' => $data['alternatedate'] ?? null,
      'time_service' => $data['timeofservice'] ?? null,
      'event_location' => $data['locationofevent'] ?? null,
      'additional_preferance' => $data['scomment'] ?? null,
      'total_days_service' => $data['smanydays'] ?? null,
      'best_time_reach' => $data['sreachyou'] ?? null,
    ]);

    $settings = Setting::first();
    Mail::to($settings->scheduling_email)->send(new SchedulingNotification($scheduling));

    return back()->with('success', 'Your scheduling request has been submitted successfully!');
  }

}

