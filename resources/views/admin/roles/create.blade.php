<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Role</h1>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.roles.store') }}" class="form">
                @csrf

                <div class="fv-row mb-10">
                    <label class="fs-5 fw-bolder form-label mb-2">
                        <span class="required">Role name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter a role name" autofocus
                        class="form-control form-control-solid @error('name') is-invalid @enderror" />
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fv-row mb-10">
                    <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <tbody class="text-gray-600 fw-bold">
                                <tr>
                                    <td class="text-gray-800">All Permissions</td>
                                    <td>
                                        <label class="form-check form-check-custom form-check-solid me-9">
                                            <input class="form-check-input" type="checkbox" id="kt_roles_select_all" />
                                            <span class="form-check-label">Select all</span>
                                        </label>
                                    </td>
                                </tr>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="text-gray-800">{{ $permission->name }}</td>
                                        <td>
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input kt-role-permission-checkbox" type="checkbox"
                                                    name="permissions[]" value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }} />
                                                <span class="form-check-label">{{ $permission->name }}</span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Role</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('kt_roles_select_all')?.addEventListener('change', function (e) {
            document.querySelectorAll('.kt-role-permission-checkbox').forEach((cb) => cb.checked = e.target.checked);
        });
    </script>
</x-app-layout>
