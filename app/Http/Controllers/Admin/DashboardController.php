<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use App\Models\Vendor;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // abort_unless(request()->user()->isAdmin(), 403);

        $stats = [
            'users'    => User::query()->count('id'),
            'vendors'  => Vendor::query()->count('id'),
            'events'   => Event::query()->count('id'),
            'bookings' => Booking::query()->count('id'),
            'revenue'  => Booking::query()->where('status', 'confirmed')->sum('total_price'),
            'pending_vendors' => Vendor::query()->where('verified', false)->count('id'),
        ];

        $recentVendors = Vendor::with('owner:id,name,email')
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Admin/Dashboard', compact('stats', 'recentVendors'));
    }
}
