@php $isSelf = $user->id === auth()->id(); @endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit User</h1>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="form">
                @csrf
                @method('PUT')

                <div class="row mb-7">
                    <div class="col-md-6 fv-row mb-7 mb-md-0">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" autofocus
                            class="form-control form-control-solid @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control form-control-solid @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-7">
                    <div class="col-md-6 fv-row mb-7 mb-md-0">
                        <label class="fs-6 fw-bolder form-label mb-2">New Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current password"
                            class="form-control form-control-solid @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-bolder form-label mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-solid" />
                    </div>
                </div>

                <div class="fv-row mb-10">
                    <label class="fs-6 fw-bolder form-label mb-2">
                        @if (!$isSelf)
                            <span class="required">Role</span>
                        @else
                            Role
                        @endif
                    </label>
                    @if ($isSelf)
                        <input type="text" class="form-control form-control-solid" value="{{ $user->roles->pluck('name')->join(', ') ?: 'No role' }}" disabled />
                        <div class="form-text">You can't change your own role. Ask another Superadmin to do it.</div>
                    @else
                        <select name="role" class="form-select form-select-solid @error('role') is-invalid @enderror">
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()?->name) === $role->name)>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    @endif
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>

            @unless ($isSelf)
                <div class="separator my-8"></div>

                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-gray-600">Deleting a user is permanent and cannot be undone.</div>
                    <button type="button" class="btn btn-light-danger"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
                        data-kt-confirm-action="{{ route('admin.users.destroy', $user) }}"
                        data-kt-confirm-message='Delete the user &quot;{{ $user->name }}&quot;? This cannot be undone.'>
                        Delete User
                    </button>
                </div>
            @endunless
        </div>
    </div>
</x-app-layout>
