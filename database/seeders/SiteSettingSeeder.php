<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SiteSetting::updateOrCreate(
            ['id' => 1], // Find by ID 1 or create new
            [
                'title' => 'Wings - Keep Flying',
                'description' => 'Innovative sportswear that blends cutting-edge technology with sleek design. For athletes and active individuals who demand more. Discover high-performance apparel that supports your journey to greatness.',
                'keywords' => 'Wings, Sportswear, Jersey, Shop, Sports Shop, Sports Market, Buy Jersey, Sell Jersey',
                'email' => 'hello@wingssportswear.shop',
                'phone' => '+88 01886424141',
                'address' => 'South Mugda, Mugdapara, Dhaka-1214',
                'social_links' => json_encode([
                    ['platform' => 'Facebook', 'username' => 'wingssportswear.shop'],
                    ['platform' => 'Instagram', 'username' => 'wingssportswear.shop']
                ]),
                // Nullable fields that will be set to null if sensitive
                'og_image' => null,
                'logo_v1' => null,
                'logo_v2' => null,
                'favicon' => null,
                'pathao_access_token' => null,
            ]
        );
    }
}
