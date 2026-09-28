<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!--begin::Small boxes-->
    {{-- The counts use p.h3 (not <h3>): same small-box styling, but they are
         numbers, not headings, so they stay out of the heading outline. --}}
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <p class="h3">{{ $stats['users'] }}</p>
                    <p>{{ Str::plural('User', $stats['users']) }}</p>
                </div>
                <i class="small-box-icon bi bi-people-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage users <i class="bi bi-arrow-right-circle" aria-hidden="true"></i>
                    </a>
                @endrole
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <p class="h3">{{ $stats['roles'] }}</p>
                    <p>{{ Str::plural('Role', $stats['roles']) }}</p>
                </div>
                <i class="small-box-icon bi bi-person-badge-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.roles.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage roles <i class="bi bi-arrow-right-circle" aria-hidden="true"></i>
                    </a>
                @endrole
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <p class="h3">{{ $stats['permissions'] }}</p>
                    <p>{{ Str::plural('Permission', $stats['permissions']) }}</p>
                </div>
                <i class="small-box-icon bi bi-key-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.permissions.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage permissions <i class="bi bi-arrow-right-circle" aria-hidden="true"></i>
                    </a>
                @endrole
            </div>
        </div>
    </div>
    <!--end::Small boxes-->

    @role('Superadmin')
        <!--begin::Recent users-->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="card-title">Recently registered users</h2>
                <div class="card-tools">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View all users</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <span class="badge text-primary-emphasis bg-primary-subtle border border-primary-subtle">{{ $role->name }}</span>
                                        @empty
                                            <span class="badge text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle">No role</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-body-secondary py-4">No users yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Recent users-->
    @endrole
</x-app-layout>
