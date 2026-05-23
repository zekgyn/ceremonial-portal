<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Models\VendorPackage;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index()
    {
        $packages = request()->user()->vendor->packages()->latest()->get();

        return Inertia::render('Vendor/Packages/Index', compact('packages'));
    }

    public function create()
    {
        return Inertia::render('Vendor/Packages/Create');
    }

    public function store(StorePackageRequest $request)
    {
        request()->user()->vendor->packages()->create($request->validated());

        return redirect()->route('vendor.packages.index')
            ->with('success', 'Package created.');
    }

    public function edit(VendorPackage $package)
    {
        $this->authorizePackage($package);

        return Inertia::render('Vendor/Packages/Edit', compact('package'));
    }

    public function update(StorePackageRequest $request, VendorPackage $package)
    {
        $this->authorizePackage($package);
        $package->update($request->validated());

        return redirect()->route('vendor.packages.index')
            ->with('success', 'Package updated.');
    }

    public function destroy(VendorPackage $package)
    {
        $this->authorizePackage($package);
        $package->delete();

        return back()->with('success', 'Package deleted.');
    }

    private function authorizePackage(VendorPackage $package): void
    {
        abort_unless($package->vendor_id === request()->user()->vendor?->id, 403);
    }
}
