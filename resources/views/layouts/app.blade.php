<!DOCTYPE html>
{{--
    Authenticated app shell, based on AdminLTE 4's default layout
    (admin-lte/dist/starter.html): fixed top navbar + collapsible main sidebar,
    content header with breadcrumbs, content area, footer.

    Slots used by pages:
      $header       page title (plain text) -- also used for <title> and the last breadcrumb
      $breadcrumbs  optional <li class="breadcrumb-item"> items between "Home" and the title
      $actions      optional page-level primary action(s), e.g. a "Create user" button
      $scripts      optional page-specific assets, rendered after the core bundles
--}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="color-scheme" content="light dark" />

		<title>{{ isset($header) ? trim(strip_tags($header)).' | ' : '' }}{{ config('app.name', 'Laravel') }}</title>

		<link rel="icon" type="image/png" href="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}" />

		<x-color-mode-init />

		@vite(['resources/css/adminlte-theme.css', 'resources/css/theme-overrides.css'])
	</head>
	<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
		<div class="app-wrapper">
			<x-topbar />
			<x-sidebar />

			<main class="app-main">
				<!--begin::App Content Header-->
				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row g-2 align-items-center">
							<div class="col-sm-6">
								<h1 class="mb-0 fs-3">{{ $header ?? config('app.name', 'Laravel') }}</h1>
							</div>
							<div class="col-sm-6 d-flex flex-column align-items-sm-end gap-2">
								<nav aria-label="Breadcrumb">
									<ol class="breadcrumb mb-0">
										@if (request()->routeIs('dashboard'))
											<li class="breadcrumb-item active" aria-current="page">Home</li>
										@else
											<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
											{{ $breadcrumbs ?? '' }}
											@isset($header)
												<li class="breadcrumb-item active" aria-current="page">{{ trim(strip_tags($header)) }}</li>
											@endisset
										@endif
									</ol>
								</nav>
								@isset($actions)
									<div class="d-flex flex-wrap gap-2">{{ $actions }}</div>
								@endisset
							</div>
						</div>
					</div>
				</div>
				<!--end::App Content Header-->
				<!--begin::App Content-->
				<div class="app-content">
					<div class="container-fluid">
						<x-flash-messages />
						{{ $slot }}
					</div>
				</div>
				<!--end::App Content-->
			</main>

			<x-footer />
		</div>

		<x-confirm-delete-modal />

		@vite(['resources/js/adminlte-theme.js', 'resources/js/app.js'])

		{{-- Per-page assets (e.g. the users DataTable). Vite entries are ES modules, so
		     they run in document order after the core bundles above. --}}
		@isset($scripts)
			{{ $scripts }}
		@endisset
	</body>
</html>
