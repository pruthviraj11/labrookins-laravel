<?php
namespace App\Http\Controllers;

use App\Mail\ContactNotification;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;

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


    public function store(Request $request)
    {
      // dd($request->all());
        $request->validate([
            'fname'   => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:150',
            'comment' => 'required|string|max:250',
        ]);


      $contact =  Contact::create([
            'name'    => $request->fname,
            'email'   => $request->email,
            'subject' => $request->subject,
            'comment' => $request->comment,
        ]);


          Mail::to('yrabadia99@gmail.com')->send(new ContactNotification($contact));

        return redirect()->back()->with('success', 'Your message has been submitted successfully!');
    }
}

