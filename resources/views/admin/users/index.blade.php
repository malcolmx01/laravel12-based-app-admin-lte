<x-app-layout>
    <x-slot name="header">Users</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
    </x-slot>
    <x-slot name="actions">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" aria-hidden="true"></i> Create user
        </a>
    </x-slot>

    <div class="card mb-4">
        <div class="card-header">
            <h2 class="card-title">All users</h2>
            <div class="card-tools">
                <form method="GET" action="{{ route('admin.users.index') }}" role="search">
                    <label for="kt_users_table_search" class="visually-hidden">Search users</label>
                    <div class="input-group input-group-sm">
                        <input type="search" id="kt_users_table_search" name="search" value="{{ $search }}"
                            class="form-control" placeholder="Name or email">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-search" aria-hidden="true"></i><span class="visually-hidden">Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0" id="kt_table_users">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/adminlte/img/avatar.png') }}" alt="" class="img-size-32 rounded-circle">
                                        <span>{{ $user->name }}</span>
                                        @if ($user->id === auth()->id())
                                            <span class="badge text-info-emphasis bg-info-subtle border border-info-subtle">You</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        <span class="badge text-primary-emphasis bg-primary-subtle border border-primary-subtle">{{ $role->name }}</span>
                                    @empty
                                        <span class="badge text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle">No role</span>
                                    @endforelse
                                </td>
                                <td class="text-end text-nowrap">
                                    <div class="d-inline-flex gap-2 position-relative">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil" aria-hidden="true"></i> Edit<span class="visually-hidden"> {{ $user->name }}</span>
                                        </a>
                                        {{-- Deleting yourself isn't allowed; the "You" badge explains the missing action. --}}
                                        @if ($user->id !== auth()->id())
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                                                data-kt-confirm-action="{{ route('admin.users.destroy', $user) }}"
                                                data-kt-confirm-message='Delete the user &quot;{{ $user->name }}&quot;? This cannot be undone.'
                                                data-kt-confirm-button="Delete user">
                                                <i class="bi bi-trash" aria-hidden="true"></i> Delete<span class="visually-hidden"> {{ $user->name }}</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-body-secondary py-4">
                                    @if ($search !== '')
                                        No users match “{{ $search }}”. <a href="{{ route('admin.users.index') }}">Clear search</a>
                                    @else
                                        No users yet. <a href="{{ route('admin.users.create') }}">Create user</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
