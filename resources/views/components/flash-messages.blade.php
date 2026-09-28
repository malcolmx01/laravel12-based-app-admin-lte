{{--
    Page-level feedback after a redirect. Success covers both `session('success')`
    and the Breeze profile `session('status')` values. Validation errors are NOT
    summarised here: every field shows its own inline error instead.
--}}
@php
    $statusMessages = [
        'profile-updated' => __('Profile updated.'),
        'password-updated' => __('Password updated.'),
        'verification-link-sent' => __('A new verification link has been sent to your email address.'),
    ];
    $success = session('success') ?? ($statusMessages[session('status')] ?? null);
@endphp

@if ($success)
    <div class="alert alert-success alert-dismissible fade show mb-4" role="status">
        <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>{{ $success }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
