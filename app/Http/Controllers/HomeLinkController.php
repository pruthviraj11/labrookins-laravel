<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeLink;

class HomeLinkController extends Controller
{
    public function edit()
    {
        $homeLink = HomeLink::first();
        return view('content/apps/home_links.edit', compact('homeLink'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title1' => 'nullable|string|max:100',
            'url1'   => 'nullable|url|max:100',
            'title2' => 'nullable|string|max:100',
            'url2'   => 'nullable|url|max:100',
            'title3' => 'nullable|string|max:100',
            'url3'   => 'nullable|url|max:100',
        ]);

        $homeLink = HomeLink::first();

        if (!$homeLink) {
            $homeLink = HomeLink::create($request->only([
                'title1', 'url1', 'title2', 'url2', 'title3', 'url3'
            ]));
        } else {
            $homeLink->update($request->only([
                'title1', 'url1', 'title2', 'url2', 'title3', 'url3'
            ]));
        }

        return redirect()->back()->with('success', 'Home Links updated successfully!');
    }
}
