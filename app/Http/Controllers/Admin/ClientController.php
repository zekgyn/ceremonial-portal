<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        abort_unless(request()->user()->isAdmin(), 403);

        $clients = User::query()->where('role', 'client')->paginate(20);

        return Inertia::render('Admin/Clients', compact('clients'));
    }

    public function show(User $user)
    {
        abort_unless(request()->user()->isAdmin(), 403);

        $user->load('events');

        return inertia('Admin/Client', ['user' => $user]);
    }
}
