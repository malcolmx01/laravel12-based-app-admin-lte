<x-guest-layout>
    {{-- Session Status --}}
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
            <span class="text-success">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form w-100">
        @csrf

        {{-- Heading --}}
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">{{ __('Sign In') }}</h1>
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('New Here?') }}
                <a href="{{ route('register') }}" class="link-primary fw-bolder">{{ __('Create an Account') }}</a>
            </div>
        </div>

        {{-- Email Address --}}
        <div class="fv-row mb-10">
            <label for="email" class="form-label fs-6 fw-bolder text-dark">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" />
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">{{ __('Forgot Password?') }}</a>
                @endif
            </div>
            <div class="position-relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
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

        {{-- Remember Me --}}
        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid">
                <input id="remember_me" type="checkbox" name="remember" class="form-check-input" />
                <span class="form-check-label fw-bold text-gray-700 fs-6">{{ __('Remember me') }}</span>
            </label>
        </div>

        {{-- Actions --}}
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary w-100">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
