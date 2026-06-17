<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Models\Event;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = request()->user()->events()
            ->withCount('bookings')
            ->with(['bookings.vendorPackage.vendor'])
            ->latest()
            ->get()
            ->map(fn($event) => [
                'id'            => $event->id,
                'title'         => $event->title,
                'type'          => $event->type,
                'date'          => $event->date->format('Y-m-d'),
                'location'      => $event->location,
                'budget'        => $event->budget,
                'bookings_count'=> $event->bookings_count,
                'total_cost'    => $event->total_cost,
            ]);

        return Inertia::render('Client/Events/Index', compact('events'));
    }

    public function create()
    {
        return Inertia::render('Client/Events/Create');
    }

    public function store(StoreEventRequest $request)
    {
        $event = request()->user()->events()->create($request->validated());

        return redirect()->route('events.show', $event)
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $this->authorizeEvent($event);

        $event->load([
            'bookings.vendorPackage.vendor',
        ]);

        $categories = ['catering', 'venue_decoration', 'entertainment_media'];
        $bookingsByCategory = [];

        foreach ($categories as $category) {
            $bookingsByCategory[$category] = $event->bookings
                ->filter(fn($b) => $b->vendorPackage->vendor->category === $category)
                ->values();
        }

        return Inertia::render('Client/Events/Show', [
            'event'              => $event,
            'bookings_by_category' => $bookingsByCategory,
            'total_cost'         => $event->total_cost,
        ]);
    }

    public function edit(Event $event)
    {
        $this->authorizeEvent($event);

        return Inertia::render('Client/Events/Edit', compact('event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorizeEvent($event);
        $event->update($request->validated());

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $this->authorizeEvent($event);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted.');
    }

    private function authorizeEvent(Event $event): void
    {
        abort_unless($event->user_id === auth()->id(), 403);
    }
}
