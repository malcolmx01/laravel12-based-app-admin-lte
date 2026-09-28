<x-app-layout>
    <x-slot name="header">Create user</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    </x-slot>

    <form method="POST" action="{{ route('admin.users.store') }}" class="card card-outline card-primary mb-4">
        @csrf
        <div class="card-header">
            <h2 class="card-title">User details</h2>
        </div>
        <div class="card-body">
            <p class="small text-body-secondary">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <x-input-label for="name" value="Name" required />
                    <x-text-input type="text" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error for="name" :messages="$errors->get('name')" />
                </div>
                <div class="col-md-6">
                    <x-input-label for="email" value="Email" required />
                    <x-text-input type="email" id="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error for="email" :messages="$errors->get('email')" />
                </div>
                <div class="col-md-6">
                    <x-input-label for="password" value="Password" required />
                    <x-text-input type="password" id="password" name="password" required autocomplete="new-password" aria-describedby="password-help" />
                    <x-input-error for="password" :messages="$errors->get('password')" />
                    <div id="password-help" class="form-text">At least 8 characters.</div>
                </div>
                <div class="col-md-6">
                    <x-input-label for="password_confirmation" value="Confirm password" required />
                    <x-text-input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <div class="col-md-6">
                    <x-input-label for="role" value="Role" required />
                    <select id="role" name="role" required
                        class="form-select @error('role') is-invalid @enderror"
                        @error('role') aria-invalid="true" aria-describedby="role-error" @enderror
                        @if (($errors->keys()[0] ?? null) === 'role') autofocus @endif>
                        <option value="">Select a role…</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" @selected(old('role') === $role->name)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="role" :messages="$errors->get('role')" />
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create user</button>
        </div>
    </form>
</x-app-layout>
