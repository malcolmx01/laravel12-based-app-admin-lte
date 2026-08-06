<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     */
    public function index(): View
    {
        $permissions = Permission::withCount('roles')->orderBy('name')->get();

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created permission.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions,name'],
        ]);

        Permission::create(['name' => $validated['name'], 'guard_name' => 'web']);

        return redirect()->route('admin.permissions.index')
            ->with('success', "Permission \"{$validated['name']}\" was created.");
    }
}
