<x-guest-layout>
    {{-- Session Status --}}
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
            <span class="text-success">{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="form w-100">
        @csrf

        {{-- Heading --}}
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">{{ __('Forgot Password?') }}</h1>
            <div class="text-gray-400 fw-bold fs-4">
                {{ __('Enter your email to reset your password.') }}
            </div>
        </div>

        {{-- Email Address --}}
        <div class="fv-row mb-10">
            <label for="email" class="form-label fw-bolder text-gray-900 fs-6">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" />
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" class="btn btn-lg btn-primary fw-bolder me-4">
                {{ __('Email Password Reset Link') }}
            </button>
            <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</x-guest-layout>
