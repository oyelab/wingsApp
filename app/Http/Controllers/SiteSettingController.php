<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    // Display the settings form
    public function index()
    {
        $settings = SiteSetting::first();
        return view('backEnd.siteSettings.create', compact('settings'));
    }

    // Update the site settings
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',  // Optional image file validation
            'logo_v1' => 'nullable|image|max:2048',
            'logo_v2' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        // Handle image uploads
        $data = $request->all();
        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('settings', 'public');
        }
        if ($request->hasFile('logo_v1')) {
            $data['logo_v1'] = $request->file('logo_v1')->store('settings', 'public');
        }
        if ($request->hasFile('logo_v2')) {
            $data['logo_v2'] = $request->file('logo_v2')->store('settings', 'public');
        }

        // Save the settings to the database
        $settings = SiteSetting::firstOrNew();
        $settings->fill($data);
        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}