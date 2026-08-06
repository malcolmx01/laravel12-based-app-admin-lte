<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="form w-100">
        @csrf

        {{-- Password Reset Token --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Heading --}}
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">{{ __('Setup New Password') }}</h1>
        </div>

        {{-- Email Address --}}
        <div class="fv-row mb-7">
            <label for="email" class="form-label fw-bolder text-dark fs-6">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" />
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="fv-row mb-7">
            <label for="password" class="form-label fw-bolder text-dark fs-6">{{ __('Password') }}</label>
            <div class="position-relative">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-toggle="true">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="fv-row mb-10">
            <label for="password_confirmation" class="form-label fw-bolder text-dark fs-6">{{ __('Confirm Password') }}</label>
            <div class="position-relative">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-toggle="true">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
