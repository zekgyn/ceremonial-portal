<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $vendor = request()->user()->vendor;

        if (!$vendor) {
            return redirect()->route('vendor.profile.create');
        }

        $bookings = Booking::whereHas('vendorPackage', fn($q) => $q->where('vendor_id', $vendor->id))
            ->with(['vendorPackage', 'event.user'])
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_packages'  => $vendor->packages()->count(),
            'total_bookings'  => $vendor->bookings()->count(),
            'pending'         => $vendor->bookings()->where('status', 'pending')->count(),
            'confirmed'       => $vendor->bookings()->where('status', 'confirmed')->count(),
            'revenue'         => $vendor->bookings()->where('status', 'confirmed')->sum('total_price'),
        ];

        return Inertia::render('Vendor/Dashboard', compact('vendor', 'bookings', 'stats'));
    }
}
