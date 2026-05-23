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
        abort_unless(request()->user()->isAdmin(), 403);

        $stats = [
            'users'    => User::count(),
            'vendors'  => Vendor::count(),
            'events'   => Event::count(),
            'bookings' => Booking::count(),
            'revenue'  => Booking::where('status', 'confirmed')->sum('total_price'),
            'pending_vendors' => Vendor::where('verified', false)->count(),
        ];

        $recentVendors = Vendor::with('user:id,firstname,lastname,email')
            ->latest()
            ->take(10)
            ->get();

        return Inertia::render('Admin/Dashboard', compact('stats', 'recentVendors'));
    }
}
