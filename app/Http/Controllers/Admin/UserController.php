<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users with their current role(s).
     */
    public function index(): View
    {
        $users = User::with('roles')->orderBy('name')->get();
        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Update the role assigned to the given user.
     */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot change your own role.');
        }

        $validated = $request->validate([
            'role' => ['required', 'string', 'exists:roles,name'],
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')
            ->with('success', "{$user->name}'s role was updated to \"{$validated['role']}\".");
    }
}
