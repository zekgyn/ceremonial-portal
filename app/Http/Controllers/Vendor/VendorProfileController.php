<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\StoreVendorRequest;
use App\Models\Vendor;
use Inertia\Inertia;

class VendorProfileController extends Controller
{
    public function show()
    {
        $vendor = request()->user()->vendor()->with('packages')->first();

        return Inertia::render('Vendor/Profile', compact('vendor'));
    }

    public function create()
    {
        return Inertia::render('Vendor/ProfileSetup');
    }

    public function store(StoreVendorRequest $request)
    {
        $vendor = request()->user()->vendor()->create($request->validated());

        return redirect()->route('vendor.dashboard')
            ->with('success', 'Vendor profile created.');
    }

    public function update(StoreVendorRequest $request)
    {
        request()->user()->vendor->update($request->validated());

        return back()->with('success', 'Profile updated.');
    }
}
