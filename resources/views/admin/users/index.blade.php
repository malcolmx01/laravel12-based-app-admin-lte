<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Users</h1>
    </x-slot>

    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <div class="card-title">
                <h2>All Users</h2>
            </div>
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-200px">Name</th>
                            <th class="min-w-200px">Email</th>
                            <th class="min-w-125px">Current Role</th>
                            <th class="text-end min-w-250px">Change Role</th>
                        </tr>
                    </thead>
                    <tbody class="fw-bold text-gray-600">
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-35px me-3">
                                            <img src="{{ asset('assets/media/avatars/150-1.jpg') }}" alt="{{ $user->name }}" />
                                        </div>
                                        <span class="text-gray-800">{{ $user->name }}</span>
                                        @if ($user->id === auth()->id())
                                            <span class="badge badge-light fs-8 ms-2">You</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ($user->roles as $role)
                                        <span class="badge badge-light-primary fs-7 m-1">{{ $role->name }}</span>
                                    @empty
                                        <span class="badge badge-light-danger fs-7 m-1">No role</span>
                                    @endforelse
                                </td>
                                <td class="text-end">
                                    @if ($user->id === auth()->id())
                                        <span class="text-muted fst-italic">You can't change your own role</span>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="d-flex justify-content-end">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select form-select-solid w-175px me-3">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-light-primary">Update</button>
                                        </form>
                                    @endif
                                </td>
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
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-app-layout>
