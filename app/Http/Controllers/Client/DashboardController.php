<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = request()->user();

        $events = $user->events()
            ->with(['bookings.vendorPackage.vendor'])
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($event) => [
                'id'         => $event->id,
                'title'      => $event->title,
                'type'       => $event->type,
                'date'       => $event->date->format('Y-m-d'),
                'location'   => $event->location,
                'total_cost' => $event->total_cost,
                'bookings'   => $event->bookings->count(),
            ]);

        $stats = [
            'total_events'   => $user->events()->count(),
            'upcoming_events'=> $user->events()->whereDate('date', '>=', now())->count(),
            'total_bookings' => \App\Models\Booking::whereHas('event', fn($q) => $q->where('user_id', $user->id))->count(),
        ];

        return Inertia::render('Client/Dashboard', compact('events', 'stats'));
    }
}
