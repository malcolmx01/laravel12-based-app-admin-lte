<x-app-layout>
    <x-slot name="header">Profile</x-slot>
    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">Account</li>
    </x-slot>

    <div class="row g-4 mb-4">
        <div class="col-xl-8 order-2 order-xl-1">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
        <div class="col-xl-4 order-1 order-xl-2">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/adminlte/img/avatar.png') }}" alt="" class="img-size-64 rounded-circle">
                    <div>
                        <p class="fw-bold mb-0">{{ $user->name }}</p>
                        <p class="small text-body-secondary mb-2">{{ $user->email }}</p>
                        @forelse ($user->roles as $role)
                            <span class="badge text-primary-emphasis bg-primary-subtle border border-primary-subtle">{{ $role->name }}</span>
                        @empty
                            <span class="badge text-secondary-emphasis bg-secondary-subtle border border-secondary-subtle">No role</span>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer small text-body-secondary">Member since {{ $user->created_at?->format('F Y') }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
