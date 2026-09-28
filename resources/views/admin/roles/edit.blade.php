<x-app-layout>
    <x-slot name="header">Edit role</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    </x-slot>

    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="card card-outline card-primary mb-4">
        @csrf
        @method('PUT')
        <div class="card-header">
            <h2 class="card-title">Role details</h2>
        </div>
        <div class="card-body">
            <p class="small text-body-secondary">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
            <div class="row g-3">
                <div class="col-md-6">
                    @if ($isProtected)
                        {{-- Not submitted: the controller keeps a protected role's name. --}}
                        <x-input-label for="name" value="Role name" />
                        <x-text-input type="text" id="name" :value="$role->name" disabled aria-describedby="name-help" />
                        <div id="name-help" class="form-text">
                            <i class="bi bi-lock-fill" aria-hidden="true"></i> System role: the app relies on this name, so it can't be changed. Its permissions can.
                        </div>
                    @else
                        <x-input-label for="name" value="Role name" required />
                        <x-text-input type="text" id="name" name="name" :value="old('name', $role->name)" required autofocus />
                        <x-input-error for="name" :messages="$errors->get('name')" />
                    @endif
                </div>
            </div>
            <hr class="my-4">
            @include('admin.roles.partials.permissions-fieldset', ['selected' => old('permissions', $rolePermissions)])
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    @php
        $deleteBlockedReason = match (true) {
            $isProtected => 'This is a system role, so it can\'t be deleted.',
            $role->users_count > 0 => 'This role is assigned to '.$role->users_count.' '.Str::plural('user', $role->users_count).'. Give them another role before deleting it.',
            default => null,
        };
    @endphp
    <div class="card card-outline card-danger mb-4">
        <div class="card-header">
            <h2 class="card-title">Delete role</h2>
        </div>
        <div class="card-body">
            @if ($deleteBlockedReason)
                <p id="delete-role-reason" class="mb-0">{{ $deleteBlockedReason }}</p>
            @else
                <p class="mb-0">Deleting a role is permanent and cannot be undone.</p>
            @endif
        </div>
        <div class="card-footer d-flex justify-content-end">
            @if ($deleteBlockedReason)
                <button type="button" class="btn btn-outline-danger" disabled aria-describedby="delete-role-reason">
                    <i class="bi bi-trash" aria-hidden="true"></i> Delete role
                </button>
            @else
                <button type="button" class="btn btn-outline-danger"
                    data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                    data-kt-confirm-action="{{ route('admin.roles.destroy', $role) }}"
                    data-kt-confirm-message='Delete the &quot;{{ $role->name }}&quot; role? This cannot be undone.'
                    data-kt-confirm-button="Delete role">
                    <i class="bi bi-trash" aria-hidden="true"></i> Delete role
                </button>
            @endif
        </div>
    </div>
</x-app-layout>
