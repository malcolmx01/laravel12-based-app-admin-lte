<!DOCTYPE html>
<!--
Base layout ported from the Metronic demo (resources/metronic-source/demo1/dist/index.html).
Structure, class names, and data-kt-* attributes are preserved as-is so Metronic's JS
(scripts.bundle.js / plugins.bundle.js) continues to work unmodified. See the Phase 2
report for a list of demo features that were intentionally not carried over.
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

		<!--begin::Metronic + app assets (compiled by Vite)-->
		{{-- app.css (Tailwind) must load BEFORE the Metronic/Bootstrap bundles: Tailwind's
		     preflight reset and Bootstrap's reboot both target bare elements (h1, ul, a, ...)
		     at equal specificity, so load order decides the winner. Metronic pages are written
		     in Bootstrap classes and need Bootstrap's reboot to win; Tailwind utility classes
		     (used by a couple of not-yet-restyled Breeze views sharing this layout) are
		     class-selectors and stay unaffected either way. --}}
		@vite([
			'resources/css/app.css',
			'resources/css/metronic/plugins/plugins.bundle.css',
			'resources/css/metronic/style.bundle.css',
		])
		<!--end::Metronic + app assets-->
	</head>
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<x-sidebar />
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<x-topbar />
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
									@isset($header)
										{{ $header }}
									@else
										<h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ config('app.name', 'Laravel') }}</h1>
									@endisset
								</div>
								<!--end::Page title-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<x-flash-messages />
								{{ $slot }}
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<x-footer />
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<x-confirm-delete-modal />

		{{-- Metronic's theme scripts are legacy global-scope/UMD bundles, served as
		     static passthrough assets (not compiled by Vite) -- see
		     public/assets/js/metronic/README.md for why. --}}
		<script src="{{ asset('assets/js/metronic/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/metronic/scripts.bundle.js') }}"></script>
		@vite(['resources/js/app.js'])

		{{-- Per-page scripts (e.g. DataTables init), rendered after the core bundles
		     above so page scripts can rely on jQuery/KTUtil/etc. already being global. --}}
		@isset($scripts)
			{{ $scripts }}
		@endisset
	</body>
	<!--end::Body-->
</html>
