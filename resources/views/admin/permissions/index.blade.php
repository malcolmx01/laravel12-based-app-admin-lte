<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Permissions</h1>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <div class="card-title">
                <h2>All Permissions</h2>
            </div>
            <div class="card-toolbar">
                <form method="POST" action="{{ route('admin.permissions.store') }}" class="d-flex align-items-start">
                    @csrf
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. manage invoices"
                            class="form-control form-control-solid w-250px @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-light-primary ms-3">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Add Permission
                    </button>
                </form>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-250px">Assigned to</th>
                            <th class="text-end min-w-100px">Roles using it</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    @forelse ($permission->roles as $role)
                                        <span class="fs-7 m-1">{{ $role->name }}</span>
                                    @empty
                                        <span class="text-muted fst-italic">Not assigned to any role</span>
                                    @endforelse
                                </td>
                                <td class="text-end">{{ $permission->roles_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-10">No permissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-app-layout>
