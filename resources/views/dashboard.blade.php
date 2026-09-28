{{--
    Real dashboard content -- replaces the Metronic demo's "Sales Statistics" /
    "Activities" widgets, which showed fabricated data (fake sales figures, a
    fake activity feed with garbled placeholder text). See the Phase 5 report
    for why those were removed rather than restyled.
--}}
<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
    </x-slot>

    <!--begin::Stat cards-->
    <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
        <div class="col-xl-4">
            <div class="card card-flush h-md-100">
                <div class="card-body d-flex align-items-center">
                    <span class="svg-icon svg-icon-3x svg-icon-primary me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M22 12.5C22 13.3 21.3 14 20.5 14C19.7 14 19 13.3 19 12.5V9.5C19 8.7 19.7 8 20.5 8C21.3 8 22 8.7 22 9.5V12.5ZM5 9.5C5 8.7 4.3 8 3.5 8C2.7 8 2 8.7 2 9.5V12.5C2 13.3 2.7 14 3.5 14C4.3 14 5 13.3 5 12.5V9.5Z" fill="currentColor" />
                            <path d="M12 13C14.2091 13 16 11.2091 16 9C16 6.79086 14.2091 5 12 5C9.79086 5 8 6.79086 8 9C8 11.2091 9.79086 13 12 13Z" fill="currentColor" />
                            <path opacity="0.3" d="M12 14C8.7 14 6 16.7 6 20C6 20.6 6.4 21 7 21H17C17.6 21 18 20.6 18 20C18 16.7 15.3 14 12 14Z" fill="currentColor" />
                        </svg>
                    </span>
                    <div>
                        <div class="fs-2 fw-bolder text-gray-800">{{ $stats['users'] }}</div>
                        <div class="fs-6 text-gray-500">{{ Str::plural('User', $stats['users']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush h-md-100">
                <div class="card-body d-flex align-items-center">
                    <span class="svg-icon svg-icon-3x svg-icon-success me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12Z" fill="currentColor" />
                            <path d="M12 15.5C13.933 15.5 15.5 13.933 15.5 12C15.5 10.067 13.933 8.5 12 8.5C10.067 8.5 8.5 10.067 8.5 12C8.5 13.933 10.067 15.5 12 15.5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <div>
                        <div class="fs-2 fw-bolder text-gray-800">{{ $stats['roles'] }}</div>
                        <div class="fs-6 text-gray-500">{{ Str::plural('Role', $stats['roles']) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card card-flush h-md-100">
                <div class="card-body d-flex align-items-center">
                    <span class="svg-icon svg-icon-3x svg-icon-warning me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="currentColor" />
                            <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="currentColor" />
                            <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="currentColor" />
                        </svg>
                    </span>
                    <div>
                        <div class="fs-2 fw-bolder text-gray-800">{{ $stats['permissions'] }}</div>
                        <div class="fs-6 text-gray-500">{{ Str::plural('Permission', $stats['permissions']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Stat cards-->

    @role('Superadmin')
        <!--begin::Recent users-->
        <div class="card card-flush">
            <div class="card-header mt-6">
                <div class="card-title">
                    <h2>Recently Registered Users</h2>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-light-primary">View All Users</a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Name</th>
                                <th class="min-w-200px">Email</th>
                                <th class="min-w-125px">Role</th>
                                <th class="min-w-125px">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            @forelse ($recentUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <span class="badge badge-light-primary fs-7 m-1">{{ $role->name }}</span>
                                        @empty
                                            <span class="badge badge-light-danger fs-7 m-1">No role</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-10">No users yet.</td>
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
