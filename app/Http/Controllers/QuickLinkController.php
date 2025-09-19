<?php

namespace App\Http\Controllers;

use App\Models\QuickLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuickLinkController extends Controller
{
    public function edit()
    {
        $quickLinks = QuickLink::first();
        return view('content/apps/quick_links.edit', compact('quickLinks'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1' => 'required|string|max:50',
            'url1'   => 'required|string|max:250',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'title2' => 'required|string|max:50',
            'url2'   => 'required|string|max:50',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'title3' => 'required|string|max:50',
            'url3'   => 'required|string|max:50',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'title4' => 'nullable|string|max:100',
            'url4'   => 'nullable|string|max:100',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $quickLinks = QuickLink::first();

        if (!$quickLinks) {
            $quickLinks = new QuickLink();
        }

        // Handle image uploads
        foreach (['1','2','3','4'] as $i) {
            if ($request->hasFile("image$i")) {
                if ($quickLinks->{"image$i"} && Storage::exists($quickLinks->{"image$i"})) {
                    Storage::delete($quickLinks->{"image$i"});
                }
               $path = $request->file("image$i")->store('quick_links', 'public');
                $quickLinks->{"image$i"} = $path;
            }
        }

        // Update text fields
        $quickLinks->fill($request->only([
            'title1','url1',
            'title2','url2',
            'title3','url3',
            'title4','url4',
        ]));

        $quickLinks->save();

        return redirect()->back()->with('success', 'Quick Links updated successfully!');
    }
}
