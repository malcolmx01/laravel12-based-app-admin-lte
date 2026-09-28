<x-app-layout>
    <x-slot name="header">Permissions</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
    </x-slot>

    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <form method="POST" action="{{ route('admin.permissions.store') }}" class="card card-outline card-primary">
                @csrf
                <div class="card-header">
                    <h2 class="card-title">Create permission</h2>
                </div>
                <div class="card-body">
                    <x-input-label for="name" value="Permission name" required />
                    <x-text-input type="text" id="name" name="name" :value="old('name')" required aria-describedby="name-help" />
                    <x-input-error for="name" :messages="$errors->get('name')" />
                    <div id="name-help" class="form-text">Lower case, e.g. “manage invoices”. Assign it to roles on the role’s edit page.</div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">Create permission</button>
                </div>
            </form>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">All permissions</h2>
                    <div class="card-tools">
                        <form method="GET" action="{{ route('admin.permissions.index') }}" role="search">
                            <label for="permissions-search" class="visually-hidden">Search permissions</label>
                            <div class="input-group input-group-sm">
                                <input type="search" id="permissions-search" name="search" value="{{ $search }}"
                                    class="form-control" placeholder="Permission name">
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
                                    <th scope="col">Assigned to</th>
                                    <th scope="col" class="text-end">Roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @forelse ($permission->roles as $role)
                                                <span class="badge text-primary-emphasis bg-primary-subtle border border-primary-subtle">{{ $role->name }}</span>
                                            @empty
                                                <span class="badge text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle">Not assigned</span>
                                            @endforelse
                                        </td>
                                        <td class="text-end"><span class="badge rounded-pill text-bg-secondary">{{ $permission->roles_count }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-body-secondary py-4">
                                            @if ($search !== '')
                                                No permissions match “{{ $search }}”. <a href="{{ route('admin.permissions.index') }}">Clear search</a>
                                            @else
                                                No permissions yet. Create one with the form.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($permissions->hasPages())
                    <div class="card-footer">
                        {{ $permissions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
