<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $vendor = request()->user()->vendor;

        $bookings = Booking::whereHas('vendorPackage', fn($q) => $q->where('vendor_id', $vendor->id))
            ->with(['vendorPackage', 'event.user'])
            ->latest()
            ->get();

        return Inertia::render('Vendor/Bookings/Index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        abort_unless(
            $booking->vendorPackage->vendor_id === request()->user()->vendor?->id,
            403
        );

        $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated.');
    }
}
