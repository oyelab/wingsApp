<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
		'title',
        'description',
        'keywords',
        'og_image',
        'logo_v1',
        'logo_v2',
        'favicon',
        'email',
        'phone',
        'address',
        'social_links',
    ];

    // Cast social links as an array
    protected $casts = [
        'social_links' => 'array',
		
    ];

	// Add an accessor for the favicon path
    public function getFaviconAttribute($value)
    {
        // Return the full URL for the favicon
        return asset('storage/settings/' . $value);
    }

	public function getImagePath($attribute)
    {
        // Get the value of the specified attribute
        $value = $this->{$attribute}; 

        // Return the full URL for the image
        return asset('storage/settings/' . $value);
    }

	// public function getSocialLinksAttribute()
    // {
    //     // Decode the social_links JSON string and return it as an array
    //     return json_decode($this->social_links, true);
    // }

	// Add a method to get icon mapping
    public function getSocialIconMapping()
    {
        return [
            'facebook' => 'bi bi-facebook',
            'instagram' => 'bi bi-instagram',
            'x' => 'bi bi-twitter-x',
            'youtube' => 'bi bi-youtube',
            'linkedin' => 'bi bi-linkedin',
            'whatsapp' => 'bi bi-whatsapp',
            // Add more mappings as needed
        ];
    }
}
