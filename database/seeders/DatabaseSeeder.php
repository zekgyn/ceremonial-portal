<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Booking;
use App\Models\VendorPackage;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        $admin = User::create([
            'name' => 'System Admin',
            'email'     => 'admin@ceremony.test',
            'phone'     => '+255700000000',
            'password'  => Hash::make('Pa$$w0rd'),
            'role'      => 'admin',
        ]);

        // Demo client
        // $client = User::create([
        //     'firstname'  => 'Amina',
        //     'middlename' => 'Juma',
        //     'lastname'   => 'Mbeki',
        //     'email'      => 'client@ceremony.test',
        //     'phone'      => '+255711111111',
        //     'password'   => Hash::make('password'),
        //     'role'       => 'client',
        // ]);

        // Vendor users + profiles + packages
        // $vendorData = [
        //     [
        //         'user' => ['firstname' => 'Hassan', 'lastname' => 'Kipchoge', 'email' => 'catering1@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'Kilimanjaro Catering Co.',
        //             'description'   => 'Premium catering for weddings and corporate events across Tanzania.',
        //             'category'      => 'catering',
        //             'location'      => 'Dar es Salaam',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'Silver Buffet', 'description' => 'Full buffet for up to 100 guests. Swahili cuisine.', 'price' => 850000, 'guest_limit' => 100],
        //             ['name' => 'Gold Banquet', 'description' => 'Plated 3-course meal for up to 200 guests.', 'price' => 2100000, 'guest_limit' => 200],
        //             ['name' => 'Diamond Gala', 'description' => 'Luxury 5-course fine dining experience.', 'price' => 4500000, 'guest_limit' => 300],
        //         ],
        //     ],
        //     [
        //         'user' => ['firstname' => 'Fatuma', 'lastname' => 'Ally', 'email' => 'catering2@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'Zanzibar Spice Kitchen',
        //             'description'   => 'Authentic coastal cuisine with a modern twist.',
        //             'category'      => 'catering',
        //             'location'      => 'Zanzibar',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'Coastal Feast', 'description' => 'Seafood-centred buffet for up to 80 guests.', 'price' => 680000, 'guest_limit' => 80],
        //             ['name' => 'Island Premium', 'description' => 'Multi-course island cuisine for up to 150 guests.', 'price' => 1750000, 'guest_limit' => 150],
        //         ],
        //     ],
        //     [
        //         'user' => ['firstname' => 'David', 'lastname' => 'Mwangi', 'email' => 'venue1@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'Serengeti Décor & Events',
        //             'description'   => 'Transforming venues into breathtaking spaces since 2015.',
        //             'category'      => 'venue_decoration',
        //             'location'      => 'Arusha',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'Garden Elegance', 'description' => 'Floral arrangements and draping for outdoor ceremonies.', 'price' => 950000, 'guest_limit' => null],
        //             ['name' => 'Royal Ballroom', 'description' => 'Full venue transformation with lighting and floral.', 'price' => 2800000, 'guest_limit' => null],
        //             ['name' => 'Minimalist Luxe', 'description' => 'Clean, modern décor with accent lighting.', 'price' => 1400000, 'guest_limit' => null],
        //         ],
        //     ],
        //     [
        //         'user' => ['firstname' => 'Grace', 'lastname' => 'Okonkwo', 'email' => 'venue2@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'Coastal Blooms',
        //             'description'   => 'Floral design studio specialising in tropical wedding aesthetics.',
        //             'category'      => 'venue_decoration',
        //             'location'      => 'Mombasa',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'Tropical Escape', 'description' => 'Lush tropical florals and greenery installations.', 'price' => 780000, 'guest_limit' => null],
        //             ['name' => 'Sunset Romance', 'description' => 'Warm toned florals with candle arrangements.', 'price' => 1200000, 'guest_limit' => null],
        //         ],
        //     ],
        //     [
        //         'user' => ['firstname' => 'Samuel', 'lastname' => 'Nkosi', 'email' => 'entertainment1@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'AfroBeats Entertainment',
        //             'description'   => 'Live bands, DJs and full audio-visual production.',
        //             'category'      => 'entertainment_media',
        //             'location'      => 'Nairobi',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'DJ Package', 'description' => 'Professional DJ with sound system for 6 hours.', 'price' => 550000, 'guest_limit' => null],
        //             ['name' => 'Live Band', 'description' => '5-piece live band for 4 hours with MC.', 'price' => 1900000, 'guest_limit' => null],
        //             ['name' => 'Full Production', 'description' => 'DJ, band, MC, lighting rig, and LED screen.', 'price' => 3800000, 'guest_limit' => null],
        //         ],
        //     ],
        //     [
        //         'user' => ['firstname' => 'Mercy', 'lastname' => 'Kamau', 'email' => 'entertainment2@ceremony.test'],
        //         'vendor' => [
        //             'business_name' => 'Luminary Films & Photo',
        //             'description'   => 'Award-winning wedding photography and cinematography.',
        //             'category'      => 'entertainment_media',
        //             'location'      => 'Dar es Salaam',
        //             'verified'      => true,
        //         ],
        //         'packages' => [
        //             ['name' => 'Photo Essentials', 'description' => 'Full-day photography coverage. 300 edited photos.', 'price' => 850000, 'guest_limit' => null],
        //             ['name' => 'Cinematic Day', 'description' => 'Photo + video. Highlight film + full ceremony edit.', 'price' => 2200000, 'guest_limit' => null],
        //         ],
        //     ],
        // ];

        // $createdVendors = [];

        // foreach ($vendorData as $data) {
        //     $user = User::create(array_merge($data['user'], [
        //         'phone'    => '+255' . rand(700000000, 799999999),
        //         'password' => Hash::make('password'),
        //         'role'     => 'vendor',
        //     ]));

        //     $vendor = $user->vendor()->create($data['vendor']);

        //     foreach ($data['packages'] as $pkg) {
        //         $vendor->packages()->create($pkg);
        //     }

        //     $createdVendors[] = $vendor;
        // }

        // Demo events for the client
        // $event = $client->events()->create([
        //     'title'    => 'Amina & Tariq Wedding',
        //     'type'     => 'wedding',
        //     'date'     => now()->addMonths(3)->format('Y-m-d'),
        //     'location' => 'Dar es Salaam, Tanzania',
        //     'budget'   => 8000000,
        // ]);

        // Book a package from each category
        // $cateringPkg  = VendorPackage::where('name', 'Gold Banquet')->first();
        // $venuePkg     = VendorPackage::where('name', 'Royal Ballroom')->first();
        // $entPkg       = VendorPackage::where('name', 'Cinematic Day')->first();

        // foreach ([$cateringPkg, $venuePkg, $entPkg] as $pkg) {
        //     if ($pkg) {
        //         Booking::create([
        //             'event_id'          => $event->id,
        //             'vendor_package_id' => $pkg->id,
        //             'total_price'       => $pkg->price,
        //             'status'            => 'confirmed',
        //         ]);
        //     }
        // }
    }
}
