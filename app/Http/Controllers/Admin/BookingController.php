<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Event;
use App\Models\VendorPackage;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
            ->paginate(15);

        return Inertia::render('Admin/Bookings', compact('bookings'));
    }

    // public function store(StoreBookingRequest $request)
    // {
    //     $event = Event::findOrFail($request->event_id);
    //     abort_unless($event->user_id === request()->user()->id, 403);

    //     $package = VendorPackage::findOrFail($request->vendor_package_id);

    //     // Replace existing booking for same category within this event
    //     $existingBooking = Booking::whereHas(
    //         'vendorPackage.vendor',
    //         fn($q) => $q->where('category', $package->vendor->category)
    //     )->where('event_id', $event->id)->first();

    //     if ($existingBooking) {
    //         $existingBooking->update([
    //             'vendor_package_id' => $package->id,
    //             'total_price'       => $package->price,
    //             'status'            => 'pending',
    //         ]);
    //     } else {
    //         Booking::create([
    //             'event_id'          => $event->id,
    //             'vendor_package_id' => $package->id,
    //             'total_price'       => $package->price,
    //             'status'            => 'pending',
    //         ]);
    //     }

    //     return redirect()->route('events.show', $event)
    //         ->with('success', 'Package booked successfully.');
    // }

    // public function destroy(Booking $booking)
    // {
    //     abort_unless($booking->event->user_id === auth()->id(), 403);
    //     $booking->delete();

    //     return back()->with('success', 'Booking removed.');
    // }
}
