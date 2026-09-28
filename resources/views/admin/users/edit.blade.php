@php $isSelf = $user->id === auth()->id(); @endphp
<x-app-layout>
    <x-slot name="header">Edit user</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    </x-slot>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="card card-outline card-primary mb-4">
        @csrf
        @method('PUT')
        <div class="card-header">
            <h2 class="card-title">User details</h2>
        </div>
        <div class="card-body">
            <p class="small text-body-secondary">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <x-input-label for="name" value="Name" required />
                    <x-text-input type="text" id="name" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error for="name" :messages="$errors->get('name')" />
                </div>
                <div class="col-md-6">
                    <x-input-label for="email" value="Email" required />
                    <x-text-input type="email" id="email" name="email" :value="old('email', $user->email)" required autocomplete="email" />
                    <x-input-error for="email" :messages="$errors->get('email')" />
                </div>
                <div class="col-md-6">
                    <x-input-label for="password" value="New password" />
                    <x-text-input type="password" id="password" name="password" autocomplete="new-password" aria-describedby="password-help" />
                    <x-input-error for="password" :messages="$errors->get('password')" />
                    <div id="password-help" class="form-text">Leave blank to keep the current password. At least 8 characters.</div>
                </div>
                <div class="col-md-6">
                    <x-input-label for="password_confirmation" value="Confirm new password" />
                    <x-text-input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" />
                </div>
                <div class="col-md-6">
                    @if ($isSelf)
                        <x-input-label for="role" value="Role" />
                        <select id="role" class="form-select" disabled aria-describedby="role-help">
                            <option>{{ $user->roles->pluck('name')->join(', ') ?: 'No role' }}</option>
                        </select>
                        <div id="role-help" class="form-text">
                            <i class="bi bi-info-circle" aria-hidden="true"></i> You can't change your own role. Ask another Superadmin to do it.
                        </div>
                    @else
                        <x-input-label for="role" value="Role" required />
                        <select id="role" name="role" required
                            class="form-select @error('role') is-invalid @enderror"
                            @error('role') aria-invalid="true" aria-describedby="role-error" @enderror
                            @if (($errors->keys()[0] ?? null) === 'role') autofocus @endif>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="role" :messages="$errors->get('role')" />
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <div class="card card-outline card-danger mb-4">
        <div class="card-header">
            <h2 class="card-title">Delete user</h2>
        </div>
        <div class="card-body">
            @if ($isSelf)
                <p id="delete-user-reason" class="mb-0">You can't delete your own account here. Use <a href="{{ route('profile.edit') }}">Profile</a> › Delete account instead.</p>
            @else
                <p class="mb-0">Deleting a user is permanent and cannot be undone.</p>
            @endif
        </div>
        <div class="card-footer d-flex justify-content-end">
            @if ($isSelf)
                <button type="button" class="btn btn-outline-danger" disabled aria-describedby="delete-user-reason">
                    <i class="bi bi-trash" aria-hidden="true"></i> Delete user
                </button>
            @else
                <button type="button" class="btn btn-outline-danger"
                    data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                    data-kt-confirm-action="{{ route('admin.users.destroy', $user) }}"
                    data-kt-confirm-message='Delete the user &quot;{{ $user->name }}&quot;? This cannot be undone.'
                    data-kt-confirm-button="Delete user">
                    <i class="bi bi-trash" aria-hidden="true"></i> Delete user
                </button>
            @endif
        </div>
    </div>
</x-app-layout>
