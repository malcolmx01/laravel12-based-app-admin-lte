<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roles</h1>
    </x-slot>

    <!--begin::Row-->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
        @foreach ($roles as $role)
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Card-->
                <div class="card card-flush h-md-100">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ $role->name }}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-1">
                        <div class="fw-bolder text-gray-600 mb-5">Total users with this role: {{ $role->users_count }}</div>
                        <div class="d-flex flex-column text-gray-600">
                            @forelse ($role->permissions as $permission)
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>{{ $permission->name }}
                                </div>
                            @empty
                                <div class="d-flex align-items-center py-2 text-muted fst-italic">No permissions assigned</div>
                            @endforelse
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer flex-wrap pt-0">
                        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-light btn-active-primary my-1 me-2">Edit Role</a>
                        <button type="button" class="btn btn-light btn-active-light-danger my-1"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                            data-kt-confirm-action="{{ route('admin.roles.destroy', $role) }}"
                            data-kt-confirm-message='Delete the &quot;{{ $role->name }}&quot; role? This cannot be undone.'>
                            Delete
                        </button>
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        @endforeach

        <!--begin::Add new card-->
        <div class="col-md-4">
            <!--begin::Card-->
            <a href="{{ route('admin.roles.create') }}" class="card h-md-100 text-decoration-none">
                <div class="card-body d-flex flex-column flex-center">
                    <img src="{{ asset('assets/media/illustrations/sketchy-1/4.png') }}" alt="" class="mw-100 mh-150px mb-7" />
                    <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                </div>
            </a>
            <!--end::Card-->
        </div>
        <!--end::Add new card-->
    </div>
    <!--end::Row-->
</x-app-layout>
