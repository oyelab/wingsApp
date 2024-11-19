<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Storage;

class SiteSettingController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('role'); // Only allow role 1 users

    }
	
    // Display the settings form
    public function index()
	{
		// Fetch the first site setting
		$settings = SiteSetting::first();

		// Initialize socialLinks array
		$socialLinks = [];

		// Check if settings exist and if social_links is a string before decoding
		if ($settings && is_string($settings->social_links)) {
			$socialLinks = json_decode($settings->social_links, true) ?: []; // Decode safely
		} elseif ($settings && is_array($settings->social_links)) {
			// If social_links is already an array, use it directly
			$socialLinks = $settings->social_links;
		}
		// return$socialLinks;
		// Pass both settings and socialLinks to the view
		return view('backEnd.siteSettings.create', [
			'settings' => $settings, 
			'socialLinks' => $socialLinks,
		]);
	}



    // Update the site settings
	public function update(Request $request)
	{
		// Validate the request, including all the fields
		$validated = $request->validate([
			'title' => 'nullable|string',
			'description' => 'nullable|string',
			'keywords' => 'nullable|string',
			'og_image' => 'nullable|image|max:2048',
			'logo_v1' => 'nullable|image|max:2048',
			'logo_v2' => 'nullable|image|max:2048',
			'favicon' => 'nullable|mimes:ico|max:128',
			'email' => 'nullable|email',
			'phone' => 'nullable|string',
			'address' => 'nullable|string',
			'social_platforms.*' => 'nullable|string',
			'social_usernames.*' => 'nullable|string',
		]);
	
		// Handle image uploads using their original filenames
		$files = ['og_image', 'logo_v1', 'logo_v2', 'favicon'];
		
		foreach ($files as $file) {
			if ($request->hasFile($file)) {
				// Get the uploaded file
				$uploadedFile = $request->file($file);
		
				// Get the original file name
				$filename = $uploadedFile->getClientOriginalName();
		
				// Store the file in the 'settings' directory within the 'public' disk
				$path = $uploadedFile->storeAs('settings', $filename, 'public');
		
				// Update the database field with the filename
				SiteSetting::updateOrCreate([], [
					$file => $filename,
				]);
			}
		}
	
		// Retrieve or create the site settings entry
		$siteSettings = SiteSetting::firstOrCreate([]);
	
		// Handle social links as JSON
		if ($request->has('social_platforms') && $request->has('social_usernames')) {
			$socialLinks = [];
			foreach ($request->social_platforms as $index => $platform) {
				$socialLinks[] = [
					'platform' => $platform,
					'username' => $request->social_usernames[$index],
				];
			}
			// Encode and store in the social_links field as JSON
			$siteSettings->social_links = json_encode($socialLinks);
		}
	
		// Update other non-file fields
		$siteSettings->update([
			'title' => $request->input('title'),
			'description' => $request->input('description'),
			'keywords' => $request->input('keywords'),
			'email' => $request->input('email'),
			'phone' => $request->input('phone'),
			'address' => $request->input('address'),
		]);
	
		// Save the settings
		$siteSettings->save();
	
		return redirect()->back()->with('success', 'Settings updated successfully.');
	}
	
	
}