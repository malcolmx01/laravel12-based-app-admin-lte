<!DOCTYPE html>
<!--
Guest/auth layout ported from Metronic's "basic" auth flow demo
(resources/metronic-source/demo1/dist/authentication/flows/basic/*.html).
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>

		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->

		{{-- app.css (Tailwind) loads before the Metronic/Bootstrap bundles -- see the
		     matching comment in layouts/app.blade.php for why. --}}
		@vite([
			'resources/css/app.css',
			'resources/css/metronic/plugins/plugins.bundle.css',
			'resources/css/metronic/style.bundle.css',
		])
	</head>
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication-->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset('assets/media/illustrations/sketchy-1/14.png') }})">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="{{ url('/') }}" class="mb-12">
						<img alt="Logo" src="{{ asset('assets/media/logos/logo-1.svg') }}" class="h-40px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						{{ $slot }}
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<div class="text-muted fw-bold fs-6">
						{{ date('Y') }}© {{ config('app.name', 'Laravel') }}
					</div>
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication-->
		</div>
		<!--end::Main-->

		{{-- Metronic's theme scripts are legacy global-scope/UMD bundles, served as
		     static passthrough assets (not compiled by Vite) -- see
		     public/assets/js/metronic/README.md for why. --}}
		<script src="{{ asset('assets/js/metronic/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/metronic/scripts.bundle.js') }}"></script>
		@vite(['resources/js/app.js'])

		{{-- Minimal password show/hide toggle for fields marked with
		     data-kt-password-toggle (Metronic's own password-meter plugin
		     is a per-page custom script we haven't ported -- see Phase 2/3 notes). --}}
		<script>
			document.addEventListener('click', function (e) {
				const trigger = e.target.closest('[data-kt-password-toggle]');
				if (!trigger) return;
				const input = trigger.parentElement.querySelector('input');
				if (!input) return;
				const isPassword = input.type === 'password';
				input.type = isPassword ? 'text' : 'password';
				trigger.querySelectorAll('i').forEach((icon) => icon.classList.toggle('d-none'));
			});
		</script>
	</body>
	<!--end::Body-->
</html>
