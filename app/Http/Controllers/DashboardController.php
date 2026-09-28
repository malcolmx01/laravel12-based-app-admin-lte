<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with real system stats.
     */
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
        ];

        $recentUsers = User::with('roles')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentUsers'));
    }
}
