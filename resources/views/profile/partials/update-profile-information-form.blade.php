{{-- Separate form: the "re-send verification" button below submits it via form="send-verification". --}}
<form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="d-none">
    @csrf
</form>

<form method="POST" action="{{ route('profile.update') }}" class="card card-outline card-primary mb-4">
    @csrf
    @method('PATCH')
    <div class="card-header">
        <h2 class="card-title">Profile information</h2>
    </div>
    <div class="card-body">
        <p class="small text-body-secondary">Update your account's name and email address. Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
        <div class="row g-3">
            <div class="col-md-6">
                <x-input-label for="name" value="Name" required />
                <x-text-input type="text" id="name" name="name" :value="old('name', $user->name)" required autocomplete="name" />
                <x-input-error for="name" :messages="$errors->get('name')" />
            </div>
            <div class="col-md-6">
                <x-input-label for="email" value="Email" required />
                <x-text-input type="email" id="email" name="email" :value="old('email', $user->email)" required autocomplete="username"
                    :aria-describedby="($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) ? 'email-help' : null" />
                <x-input-error for="email" :messages="$errors->get('email')" />
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div id="email-help" class="form-text">
                        Your email address is unverified.
                        <button type="submit" form="send-verification" class="btn btn-link btn-sm p-0 align-baseline">Re-send the verification email</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end gap-2">
        <x-primary-button>Save changes</x-primary-button>
    </div>
</form>
