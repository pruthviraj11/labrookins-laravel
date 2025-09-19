<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Contact::query()->latest();

      return DataTables::of($data)
        ->addColumn('action', function ($row) {
          return '
                    <a href="' . route('contacts.delete', $row->id) . '"
                       class="btn btn-sm text-danger confirm-delete" data-bs-toggle="tooltip" title="Delete">
                        <i data-feather="trash-2"></i>
                    </a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('content/apps/contacts.list');
  }
  public function delete($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete(); // 👈 Soft delete

    return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
  }
}

