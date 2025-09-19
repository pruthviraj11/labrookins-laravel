<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Requests\AllPageBanner\CreateAllPageBannerRequest;
use App\Http\Requests\AllPageBanner\UpdateAllPageBannerRequest;
use App\Models\Banner;
use App\Services\AllPageBannerService;
use Spatie\Permission\Models\Permission;
use DataTables;
use Illuminate\Support\Str;

class AllPageBannerController extends Controller
{

  protected $allpagebannerService;

  public function __construct(AllPageBannerService $allpagebannerService)
  {
    $this->allpagebannerService = $allpagebannerService;
    // $this->middleware('permission:all_page_banner-list|all_page_banner-create|all_page_banner-edit|all_page_banner-delete', ['only' => ['index', 'show']]);
    // $this->middleware('permission:all_page_banner-create', ['only' => ['create', 'store']]);
    // $this->middleware('permission:all_page_banner-edit', ['only' => ['edit', 'update']]);
    // $this->middleware('permission:all_page_banner-delete', ['only' => ['destroy']]);


    // Permission::create(['name' => 'all_page_banner-list', 'guard_name' => 'web', 'module_name' => 'All Page Banner']);
    // Permission::create(['name' => 'all_page_banner-create', 'guard_name' => 'web', 'module_name' => 'All Page Banner']);
    // Permission::create(['name' => 'all_page_banner-edit', 'guard_name' => 'web', 'module_name' => 'All Page Banner']);
    // Permission::create(['name' => 'all_page_banner-delete', 'guard_name' => 'web', 'module_name' => 'All Page Banner']);
  }

  public function index()
  {
    return view('content.apps.all_page_banner.list');
  }


  public function getAll()
  {
    $all_page_banners = $this->allpagebannerService->getAllallPageBanners();
    return DataTables::of($all_page_banners)
      ->addColumn('actions', function ($row) {
        $encryptedId = encrypt($row->id);
        // Update Button

        $updateButton = "<a data-bs-toggle='tooltip' title='Edit' data-bs-delay='400' class='btn-sm  text-secondary'  href='" . route('app-all_page_banner-edit', $encryptedId) . "'><i class='text-secondary' data-feather='edit'></i></a>";

        // Delete Button

        $deleteButton = "<a data-bs-toggle='tooltip' title='Delete' data-bs-delay='400' class=' btn-sm  confirm-delete' data-idos='$encryptedId' id='confirm-color  href='" . route('app-all_page_banner-delete', $encryptedId) . "'><i class='text-danger' data-feather='trash-2'></i></a>";

        return $updateButton . " " . $deleteButton;
      })
      ->addColumn('status', function ($row) {
        return $row->status
          ? '<span class="badge bg-label-success" style="color: #000 !important;">Active</span>'
          : '<span class="badge bg-label-danger">Inactive</span>';
      })->rawColumns(['actions', 'status'])->make(true);
  }

  public function create()
  {
    $all_page_banner = "";
    $page_data['page_title'] = "All Page Banner Add";
    $page_data['form_title'] = "Add New All Page Banner";


    return view('content.apps.all_page_banner.create-edit', compact('page_data', 'all_page_banner'));
  }

  public function store(CreateAllPageBannerRequest $request)
  {
    try {
      // dd($request->hasFile('image'), $request->image);
      if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('banners', 'public');
        $allPageBannerData['image'] = $imagePath;
      }
      $allPageBannerData['page'] = $request->page;
      $allPageBannerData['is_page'] = 1;

      $allPageBannerData['status'] = $request->has('status') ? 1 : 0;

      $allPageBannerData['slug_url'] = $this->generateUniqueSlug($request->page);
      // dd($request->all());
      // $roleData['display_name'] = $request->display_name;


      $all_page_banner = $this->allpagebannerService->create($allPageBannerData);
      if (!empty($all_page_banner)) {
        return redirect()->route("app-all_page_banner-list")->with('success', 'All Page Banner Added Successfully');
      } else {
        return redirect()->back()->with('error', 'Error while Adding All Page Banner ');
      }
    } catch (\Exception $error) {
      dd($error->getMessage());
      return redirect()->route("app-all_page_banner-list")->with('error', 'Error while editing All Page Banner');
    }
  }

  public function edit($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $all_page_banner = $this->allpagebannerService->getAllPageBanner($id);
      $page_data['page_title'] = "All Page Banner Edit";
      $page_data['form_title'] = "Edit All Page Banner";

      return view('/content/apps/all_page_banner/create-edit', compact('page_data', 'all_page_banner'));
    } catch (\Exception $error) {
      return redirect()->route("app-all_page_banner-list")->with('error', 'Error while editing Role');
    }
  }

  public function update(UpdateAllPageBannerRequest $request, $encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('banners', 'public');
        $allPageBannerData['image'] = $imagePath;
      }
      $allPageBannerData['page'] = $request->page;
      $allPageBannerData['is_page'] = 1;
      $allPageBannerData['status'] = $request->has('status') ? 1 : 0;
      $allPageBannerData['slug_url'] = $this->generateUniqueSlug($request->page, $id);


      $updated = $this->allpagebannerService->updateAllPageBanner($id, $allPageBannerData);


      if (!empty($updated)) {
        return redirect()->route("app-all_page_banner-list")->with('success', 'All Page Banner Updated Successfully');
      } else {
        return redirect()->back()->with('error', 'Error while Updating Role');
      }
    } catch (\Exception $error) {
      return redirect()->route("app-all_page_banner-list")->with('error', 'Error while editing All Page Banner');
    }
  }

  public function destroy($encrypted_id)
  {
    try {
      $id = decrypt($encrypted_id);
      $deleted = $this->allpagebannerService->deleteAllPageBanner($id);
      if (!empty($deleted)) {
        return redirect()->route("app-all_page_banner-list")->with('success', 'All Page Banner Deleted Successfully');
      } else {
        return redirect()->back()->with('error', 'Error while Deleting All Page Banner');
      }
    } catch (\Exception $error) {
      return redirect()->route("app-all_page_banner-list")->with('error', 'Error while editing All Page Banner');
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
