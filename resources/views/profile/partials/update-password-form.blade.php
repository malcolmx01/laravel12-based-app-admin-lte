<form method="POST" action="{{ route('password.update') }}" class="card card-outline card-primary mb-4">
    @csrf
    @method('PUT')
    <div class="card-header">
        <h2 class="card-title">Update password</h2>
    </div>
    <div class="card-body">
        <p class="small text-body-secondary">Use a long, random password to keep your account secure. Fields marked <span aria-hidden="true">*</span><span class="visually-hidden">with an asterisk</span> are required.</p>
        <div class="row g-3">
            <div class="col-md-6">
                <x-input-label for="update_password_current_password" value="Current password" required />
                <x-text-input type="password" id="update_password_current_password" name="current_password" bag="updatePassword" required autocomplete="current-password" />
                <x-input-error for="update_password_current_password" :messages="$errors->updatePassword->get('current_password')" />
            </div>
            <div class="w-100 m-0"></div>
            <div class="col-md-6">
                <x-input-label for="update_password_password" value="New password" required />
                <x-text-input type="password" id="update_password_password" name="password" bag="updatePassword" required autocomplete="new-password" aria-describedby="update_password_password-help" />
                <x-input-error for="update_password_password" :messages="$errors->updatePassword->get('password')" />
                <div id="update_password_password-help" class="form-text">At least 8 characters.</div>
            </div>
            <div class="col-md-6">
                <x-input-label for="update_password_password_confirmation" value="Confirm new password" required />
                <x-text-input type="password" id="update_password_password_confirmation" name="password_confirmation" bag="updatePassword" required autocomplete="new-password" />
                <x-input-error for="update_password_password_confirmation" :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end gap-2">
        <x-primary-button>Save changes</x-primary-button>
    </div>
</form>
