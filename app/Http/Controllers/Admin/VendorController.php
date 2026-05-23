<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Inertia\Inertia;

class VendorController extends Controller
{
    public function index()
    {
        abort_unless(request()->user()->isAdmin(), 403);

        $vendors = Vendor::with('user:id,firstname,lastname,email')
            ->withCount(['packages', 'bookings'])
            ->latest()
            ->paginate(20);

        return Inertia::render('Admin/Vendors', compact('vendors'));
    }

    public function toggleVerified(Vendor $vendor)
    {
        abort_unless(request()->user()->isAdmin(), 403);

        $vendor->update(['verified' => !$vendor->verified]);

        return back()->with('success', 'Vendor verification status updated.');
    }
}
