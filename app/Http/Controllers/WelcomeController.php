<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Welcome;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function edit()
    {
        $welcome = Welcome::first(); // single record
        return view('content/apps/welcome.edit', compact('welcome'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'text' => 'required|string|max:50',
            'url' => 'nullable|url|max:250', // optional
        ]);

        // Get the first record, or create one if it doesn't exist
        $welcome = Welcome::first();
        if (!$welcome) {
            $welcome = Welcome::create([
                'title' => $request->title,
                'description' => $request->description,
                'text' => $request->text,
                'url' => $request->url,
                'image' => null,
            ]);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($welcome->image && Storage::disk('public')->exists($welcome->image)) {
                Storage::disk('public')->delete($welcome->image);
            }

            // Store new image on public disk
            $path = $request->file('image')->store('welcome_images', 'public');
            $welcome->image = $path;
        }

        // Update other fields
        $welcome->update([
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'url' => $request->url,
        ]);

        return redirect()->back()->with('success', 'Welcome page updated successfully!');
    }
}
