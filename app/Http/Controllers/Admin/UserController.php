<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a paginated listing of the users with their current role(s),
     * optionally filtered by a name/email search.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $users = User::with('roles')
            ->when($search !== '', fn ($query) => $query->where(fn ($query) => $query
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$user->name}\" was created.");
    }

    /**
     * Show the form for editing a user.
     */
    public function edit(User $user): View
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the given user's profile, password, and role.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $isSelf = $user->id === $request->user()->id;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'role' => [$isSelf ? 'nullable' : 'required', 'string', 'exists:roles,name'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // A Superadmin editing their own account can't change their own role --
        // same self-lockout guard as the quick role-change action.
        if (! $isSelf && ! empty($validated['role'])) {
            $user->syncRoles([$validated['role']]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$user->name}\" was updated.");
    }

    /**
     * Remove the given user.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($user->hasRole('Superadmin') && User::role('Superadmin')->count() <= 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete the last remaining Superadmin.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User \"{$name}\" was deleted.");
    }
}
