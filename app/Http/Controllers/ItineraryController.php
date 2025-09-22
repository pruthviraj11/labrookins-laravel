<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ItineraryService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
class ItineraryController extends Controller
{
  protected $service;

  public function __construct(ItineraryService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    return view('content.apps.itinerary.list');
  }

  public function getData(Request $request)
  {
    $itinerarys = $this->service->getAll();

    return DataTables::of($itinerarys)
      ->addIndexColumn()
      ->editColumn('status', function ($row) {
        return $row->status ? '<span class="badge bg-label-success" style="color: #000 !important;">Active</span>'
          : '<span class="badge bg-label-danger">Inactive</span>';
      })
      ->addColumn('actions', function ($row) {
            $encryptedId = encrypt($row->id);

            $edit = "<a href='" . route('itinerary.edit', $encryptedId) . "'
                        class='btn btn-sm text-secondary' data-bs-toggle='tooltip' title='Edit'>
                        <i data-feather='edit'></i>
                     </a>";

            $delete = "<a href='" . route('itinerary.destroy', $encryptedId) . "'
                        class='btn btn-sm text-danger confirm-delete' data-bs-toggle='tooltip' title='Delete'>
                        <i data-feather='trash-2'></i>
                      </a>";

            return $edit . ' ' . $delete;
        })
      ->rawColumns(['status', 'actions'])
      ->make(true);
  }

  public function create()
  {
    return view('content.apps.itinerary.create-edit');
  }

  public function store(Request $request)
  {
    $data = $request->all();
    $data['status'] = isset($data['status']) ? 1 : 0;

        // Handle image upload
    if ($request->hasFile('image')) {
        // Store new image on public disk
        $path = $request->file('image')->store('itinerary_images', 'public');
        $data['image'] = $path;
    }

    $this->service->create($data);
    return redirect()->route('itinerary.list')->with('success', 'Itinerary added successfully');
  }

  public function edit($id)
  {
    $id = decrypt($id);
    $itinerary = $this->service->find($id);
    return view('content.apps.itinerary.create-edit', compact('itinerary'));
  }

  public function update(Request $request, $id)
  {
    // dd($request->all());
    $id = decrypt($id);

    $data = $request->all();
    $data['status'] = isset($data['status']) ? 1 : 0;

   $itinerary = $this->service->find($id);

      // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($itinerary->image && Storage::disk('public')->exists($itinerary->image)) {
            Storage::disk('public')->delete($itinerary->image);
        }

        // Store new image on public disk
        $path = $request->file('image')->store('itinerary_images', 'public');
        $data['image'] = $path;
    }
    $this->service->update($id, $data);
    return redirect()->route('itinerary.list')->with('success', 'Itinerary updated successfully');
  }

public function destroy($encrypted_id)
{
    try {
        $id = decrypt($encrypted_id);

        $deleted = $this->service->delete($id); // service accepts id

        // If AJAX, return JSON, else redirect
        if (request()->ajax()) {
            return response()->json(['status' => 'success', 'message' => 'Itinerary deleted successfully']);
        }

        return redirect()->route('itinerary.list')->with('success', 'Itinerary deleted successfully');
    } catch (\Exception $e) {
        // Log the error server-side as needed
        \Log::error('Itinerary delete error: '.$e->getMessage());

        if (request()->ajax()) {
            return response()->json(['status' => 'error', 'message' => 'Error deleting itinerary: '.$e->getMessage()], 500);
        }

        return redirect()->route('itinerary.list')->with('error', 'Error deleting itinerary');
    }
}

}
