<x-app-layout>
    <x-slot name="header">Roles</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
    </x-slot>
    <x-slot name="actions">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Create role
        </a>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="card-title">All roles</h2>
            <div class="card-tools">
                <form method="GET" action="{{ route('admin.roles.index') }}" role="search">
                    <label for="roles-search" class="visually-hidden">Search roles</label>
                    <div class="input-group input-group-sm">
                        <input type="search" id="roles-search" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Role name">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-search" aria-hidden="true"></i><span class="visually-hidden">Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Users</th>
                            <th scope="col">Permissions</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            @php $isProtected = in_array($role->name, $protectedRoles, true); @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>{{ $role->name }}</span>
                                        @if ($isProtected)
                                            <span class="badge text-warning-emphasis bg-warning-subtle border border-warning-subtle">
                                                <i class="bi bi-lock-fill" aria-hidden="true"></i> System
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td><span class="badge rounded-pill text-bg-secondary">{{ $role->users_count }}</span></td>
                                <td>
                                    @forelse ($role->permissions as $permission)
                                        <span class="badge text-primary-emphasis bg-primary-subtle border border-primary-subtle">{{ $permission->name }}</span>
                                    @empty
                                        <span class="badge text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle">No permissions</span>
                                    @endforelse
                                </td>
                                <td class="text-end text-nowrap">
                                    <div class="d-inline-flex gap-2 position-relative">
                                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil" aria-hidden="true"></i> Edit<span class="visually-hidden"> {{ $role->name }}</span>
                                        </a>
                                        {{-- System roles can't be deleted; the "System" badge explains the missing action. --}}
                                        @unless ($isProtected)
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                                                data-kt-confirm-action="{{ route('admin.roles.destroy', $role) }}"
                                                data-kt-confirm-message='Delete the &quot;{{ $role->name }}&quot; role? This cannot be undone.'
                                                data-kt-confirm-button="Delete role">
                                                <i class="bi bi-trash" aria-hidden="true"></i> Delete<span class="visually-hidden"> {{ $role->name }}</span>
                                            </button>
                                        @endunless
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-body-secondary py-4">
                                    @if ($search !== '')
                                        No roles match “{{ $search }}”. <a href="{{ route('admin.roles.index') }}">Clear search</a>
                                    @else
                                        No roles yet. <a href="{{ route('admin.roles.create') }}">Create role</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($roles->hasPages())
            <div class="card-footer">
                {{ $roles->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
