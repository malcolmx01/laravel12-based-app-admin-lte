<x-app-layout>
    <x-slot name="header">Create role</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Access Control</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
    </x-slot>

    <form method="POST" action="{{ route('admin.roles.store') }}" class="card card-outline card-primary mb-4">
        @csrf
        <div class="card-header">
            <h2 class="card-title">Role details</h2>
        </div>
        <div class="card-body">
            <p class="small text-body-secondary">Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <x-input-label for="name" value="Role name" required />
                    <x-text-input type="text" id="name" name="name" :value="old('name')" required autofocus />
                    <x-input-error for="name" :messages="$errors->get('name')" />
                </div>
            </div>
            <hr class="my-4">
            @include('admin.roles.partials.permissions-fieldset', ['selected' => old('permissions', [])])
        </div>
        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create role</button>
        </div>
    </form>
</x-app-layout>
