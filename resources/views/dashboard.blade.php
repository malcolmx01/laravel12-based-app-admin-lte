<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!--begin::Small boxes-->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $stats['users'] }}</h3>
                    <p>{{ Str::plural('User', $stats['users']) }}</p>
                </div>
                <i class="small-box-icon bi bi-people-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage users <i class="bi bi-arrow-right-circle"></i>
                    </a>
                @endrole
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $stats['roles'] }}</h3>
                    <p>{{ Str::plural('Role', $stats['roles']) }}</p>
                </div>
                <i class="small-box-icon bi bi-person-badge-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.roles.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage roles <i class="bi bi-arrow-right-circle"></i>
                    </a>
                @endrole
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $stats['permissions'] }}</h3>
                    <p>{{ Str::plural('Permission', $stats['permissions']) }}</p>
                </div>
                <i class="small-box-icon bi bi-key-fill" aria-hidden="true"></i>
                @role('Superadmin')
                    <a href="{{ route('admin.permissions.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        Manage permissions <i class="bi bi-arrow-right-circle"></i>
                    </a>
                @endrole
            </div>
        </div>
    </div>
    <!--end::Small boxes-->

    @role('Superadmin')
        <!--begin::Recent users-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recently Registered Users</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All Users</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <span class="badge text-bg-primary">{{ $role->name }}</span>
                                        @empty
                                            <span class="badge text-bg-danger">No role</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-4">No users yet.</td>
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
