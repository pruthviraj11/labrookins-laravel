<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first(); // Only one row
        return view('content/apps/settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'website_title' => 'required|string|max:200',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $data = $request->except(['logo', 'image']);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $setting = Setting::first();
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}

