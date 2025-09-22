<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeBanner\CreateHomeBannerRequest;
use App\Http\Requests\HomeBanner\UpdateHomeBannerRequest;
use App\Models\Banner;
use App\Services\HomeBannerService;
use DataTables;
use Illuminate\Support\Str;

class HomeBannerController extends Controller
{
  protected $homeBannerService;

  public function __construct(HomeBannerService $homeBannerService)
  {
    $this->homeBannerService = $homeBannerService;
  }

  public function index()
  {
    return view('content.apps.home_banner.list');
  }

  public function getAll()
  {
    $home_banners = $this->homeBannerService->getAllHomeBanners();
    return DataTables::of($home_banners)
      ->addColumn('actions', function ($row) {
        $encryptedId = encrypt($row->id);
        $updateBtn = "<a data-bs-toggle='tooltip' title='Edit' class='btn-sm text-secondary' href='" . route('home.home_banner.edit', $encryptedId) . "'><i data-feather='edit'></i></a>";
        $deleteBtn = "<a data-bs-toggle='tooltip' title='Delete' class='btn-sm  confirm-delete' data-idos='$encryptedId' href='" . route('home.home_banner.destroy', $encryptedId) . "'><i class='text-danger' data-feather='trash-2'></i></a>";

        return $updateBtn . " " . $deleteBtn;
      })
       ->addColumn('created_at', function ($row) {
        return $row->created_at ? $row->created_at->format('d M Y h:i A') : '-';
    })
      ->addColumn('status', function ($row) {
        return $row->status
          ? '<span class="badge bg-label-success" style="color: #000 !important;">Active</span>'
          : '<span class="badge bg-label-danger">Inactive</span>';
      })
      ->rawColumns(['actions', 'status'])
      ->make(true);
  }

  public function create()
  {
    $home_banner = "";
    $page_data['page_title'] = "Add Home Banner";
    $page_data['form_title'] = "Add New Home Banner";
    return view('content.apps.home_banner.create-edit', compact('page_data', 'home_banner'));
  }

  public function store(CreateHomeBannerRequest $request)
  {
    try {
      $data['title'] = $request->title;
      $data['order_by'] = $request->order_by;
      $data['status'] = $request->has('status') ? 1 : 0;
      $data['is_page'] = 0; // flag for Home Banner
      $data['slug_url'] = $this->generateUniqueSlug($request->title);

      if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('banners', 'public');
      }

      $banner = $this->homeBannerService->create($data);
      return redirect()->route("home.home_banner.list")->with('success', 'Home Banner Added Successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error while adding Home Banner');
    }
  }

  public function edit($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $home_banner = $this->homeBannerService->getHomeBanner($id);
      $page_data['page_title'] = "Edit Home Banner";
      $page_data['form_title'] = "Edit Home Banner";

      return view('content.apps.home_banner.create-edit', compact('page_data', 'home_banner'));
    } catch (\Exception $e) {
      return redirect()->route("home.home_banner.list")->with('error', 'Error while editing Home Banner');
    }
  }

  public function update(UpdateHomeBannerRequest $request, $encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);

      $data['title'] = $request->title;
      $data['order_by'] = $request->order_by;
      $data['status'] = $request->has('status') ? 1 : 0;
      $data['slug_url'] = $this->generateUniqueSlug($request->title, $id);

      if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('banners', 'public');
      }

      $updated = $this->homeBannerService->updateHomeBanner($id, $data);
      return redirect()->route("home.home_banner.list")->with('success', 'Home Banner Updated Successfully');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error while updating Home Banner');
    }
  }

  public function destroy($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $deleted = $this->homeBannerService->deleteHomeBanner($id);
      return redirect()->route("home.home_banner.list")->with('success', 'Home Banner Deleted Successfully');
    } catch (\Exception $e) {
      return redirect()->route("home.home_banner.list")->with('error', 'Error while deleting Home Banner');
    }
  }
    private function generateUniqueSlug($title, $id = null)
  {
    $slug = Str::slug($title);
    $originalSlug = $slug;
    $counter = 1;

    while (
      Banner::where('slug_url', $slug)
        ->when($id, fn($query) => $query->where('id', '!=', $id))
        ->exists()
    ) {
      $slug = $originalSlug . '-' . $counter;
      $counter++;
    }

    return $slug;
  }
}
