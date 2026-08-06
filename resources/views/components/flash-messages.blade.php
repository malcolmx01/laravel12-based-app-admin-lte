@if (session('success'))
    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" fill="currentColor" />
                <path d="M10.5 14.6L7.29999 11.4C6.89999 11 6.89999 10.4 7.29999 10C7.69999 9.6 8.29999 9.6 8.69999 10L11.2 12.5L15.7 8C16.1 7.6 16.7 7.6 17.1 8C17.5 8.4 17.5 9 17.1 9.4L11.9 14.6C11.5 15 10.9 15 10.5 14.6Z" fill="currentColor" />
            </svg>
        </span>
        <div class="d-flex flex-column">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" fill="currentColor" />
                <path d="M12 11C11.4 11 11 10.6 11 10V7C11 6.4 11.4 6 12 6C12.6 6 13 6.4 13 7V10C13 10.6 12.6 11 12 11ZM13 15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15Z" fill="currentColor" />
            </svg>
        </span>
        <div class="d-flex flex-column">
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger d-flex flex-column p-5 mb-10">
        <div class="fw-bolder mb-2">{{ __('Please fix the following:') }}</div>
        <ul class="mb-0 ps-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
