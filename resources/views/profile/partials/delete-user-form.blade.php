<div class="card card-outline card-danger mb-4">
    <div class="card-header">
        <h2 class="card-title">Delete account</h2>
    </div>
    <div class="card-body">
        <p class="mb-0">Once your account is deleted, all of its data is permanently deleted. Download anything you want to keep first.</p>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
            <i class="bi bi-trash" aria-hidden="true"></i> Delete account
        </button>
    </div>
</div>

{{-- Dedicated modal (not the shared confirm-delete one) because it needs the password.
     It reopens itself after a failed password check (resources/js/modules/modal-autoshow.js). --}}
<div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-title" aria-hidden="true"
    @if ($errors->userDeletion->isNotEmpty()) data-show-on-load @endif>
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="confirm-user-deletion-title">Delete account?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Once your account is deleted, all of its data is permanently deleted. Enter your password to confirm.</p>
                <x-input-label for="delete_account_password" value="Password" required />
                <x-text-input type="password" id="delete_account_password" name="password" bag="userDeletion" required autocomplete="current-password" />
                <x-input-error for="delete_account_password" :messages="$errors->userDeletion->get('password')" />
            </div>
            <div class="modal-footer">
                <x-secondary-button data-bs-dismiss="modal">Cancel</x-secondary-button>
                <x-danger-button data-submitting-text="Deleting…">Delete account</x-danger-button>
            </div>
        </form>
    </div>
</div>
