<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAboutUsRequest;
use App\Services\AboutUsService;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    protected $service;

    public function __construct(AboutUsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $aboutUs = $this->service->getAboutUs();
        return view('content/apps/about_us/index', compact('aboutUs'));
    }

    public function save(SaveAboutUsRequest $request)
    {
        $this->service->saveAboutUs($request->validated());
        return redirect()->route('about-us.index')->with('success', 'About Us updated successfully!');
    }
}
