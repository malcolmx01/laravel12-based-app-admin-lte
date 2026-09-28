<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * System roles the app depends on by name (e.g. the `role:Superadmin` route
     * middleware), so they can't be renamed or deleted.
     */
    public const PROTECTED_ROLES = ['Superadmin'];

    /**
     * Display a paginated listing of the roles, optionally filtered by name.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $roles = Role::withCount('users')
            ->with('permissions')
            ->when($search !== '', fn ($query) => $query->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.roles.index', [
            'roles' => $roles,
            'search' => $search,
            'protectedRoles' => self::PROTECTED_ROLES,
        ]);
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        $permissions = Permission::orderBy('name')->get();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        $role = Role::create(['name' => $validated['name'], 'guard_name' => 'web']);
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" was created.");
    }

    /**
     * Show the form for editing a role.
     */
    public function edit(Role $role): View
    {
        $role->loadCount('users');
        $permissions = Permission::orderBy('name')->get();
        $rolePermissions = $role->permissions->pluck('name')->all();
        $isProtected = in_array($role->name, self::PROTECTED_ROLES, true);

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions', 'isProtected'));
    }

    /**
     * Update the given role. A protected role keeps its name; only its
     * permissions can change.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $isProtected = in_array($role->name, self::PROTECTED_ROLES, true);

        $validated = $request->validate([
            'name' => [$isProtected ? 'prohibited' : 'required', 'string', 'max:255', 'unique:roles,name,'.$role->id],
            'permissions' => ['array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        if (! $isProtected) {
            $role->update(['name' => $validated['name']]);
        }
        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" was updated.");
    }

    /**
     * Remove the given role.
     */
    public function destroy(Role $role): RedirectResponse
    {
        if (in_array($role->name, self::PROTECTED_ROLES, true)) {
            return redirect()->route('admin.roles.index')
                ->with('error', "Role \"{$role->name}\" is a system role and cannot be deleted.");
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', "Role \"{$role->name}\" is still assigned to users and cannot be deleted.");
        }

        $name = $role->name;
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', "Role \"{$name}\" was deleted.");
    }
}
