<x-app-layout>
    <x-slot name="header">
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add User</h1>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}" class="form">
                @csrf

                <div class="row mb-7">
                    <div class="col-md-6 fv-row mb-7 mb-md-0">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" autofocus
                            class="form-control form-control-solid @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control form-control-solid @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-7">
                    <div class="col-md-6 fv-row mb-7 mb-md-0">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Password</span>
                        </label>
                        <input type="password" name="password"
                            class="form-control form-control-solid @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 fv-row">
                        <label class="fs-6 fw-bolder form-label mb-2">
                            <span class="required">Confirm Password</span>
                        </label>
                        <input type="password" name="password_confirmation" class="form-control form-control-solid" />
                    </div>
                </div>

                <div class="fv-row mb-10">
                    <label class="fs-6 fw-bolder form-label mb-2">
                        <span class="required">Role</span>
                    </label>
                    <select name="role" class="form-select form-select-solid @error('role') is-invalid @enderror">
                        <option value="">Select a role&hellip;</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
