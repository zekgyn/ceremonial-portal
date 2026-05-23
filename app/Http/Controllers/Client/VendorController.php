<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorPackage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::query()
            ->where('verified', true)
            ->when($request->category, fn($q, $c) => $q->where('category', $c))
            ->when($request->search, fn($q, $s) => $q->where('business_name', 'like', "%$s%"))
            ->withCount('packages')
            ->with('user:id,firstname,lastname')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render('Client/Vendors/Index', [
            'vendors'  => $vendors,
            'filters'  => $request->only('category', 'search'),
        ]);
    }

    public function show(Vendor $vendor)
    {
        $vendor->load(['packages', 'user:id,firstname,lastname']);

        return Inertia::render('Client/Vendors/Show', compact('vendor'));
    }

    public function packageShow(VendorPackage $package)
    {
        $package->load('vendor.user');

        $userEvents = request()->user()->events()
            ->select('id', 'title', 'date')
            ->get();

        return Inertia::render('Client/Vendors/Package', [
            'package'     => $package,
            'user_events' => $userEvents,
        ]);
    }
}
