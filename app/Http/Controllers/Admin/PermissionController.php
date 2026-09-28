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
     * Display a paginated listing of the permissions, optionally filtered by name.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $permissions = Permission::with('roles')
            ->withCount('roles')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.permissions.index', compact('permissions', 'search'));
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
