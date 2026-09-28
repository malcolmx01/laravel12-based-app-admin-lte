{{-- Metronic header/topbar. Ported from resources/metronic-source/demo1/dist/index.html --}}
{{-- Note: the demo's duplicate horizontal "header-menu" mega-nav (mobile-only, redundant with the
     aside's own built-in mobile drawer mode) was intentionally omitted -- see Phase 2 report. --}}
<div id="kt_header" class="header align-items-stretch">
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Aside mobile toggle-->
							<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
								<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</div>
							</div>
							<!--end::Aside mobile toggle-->
							<!--begin::Mobile logo-->
							<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
								<a href="{{ route('dashboard') }}" class="d-lg-none">
									<img alt="Logo" src="{{ asset('assets/media/logos/logo-2.svg') }}" class="h-30px" />
								</a>
							</div>
							<!--end::Mobile logo-->
		<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
								<!--begin::Topbar-->
								<div class="d-flex align-items-stretch flex-shrink-0 ms-auto">
									<!--begin::Toolbar wrapper-->
									<div class="d-flex align-items-stretch flex-shrink-0">
										<!--begin::Search-->
										{{-- A plain KTMenu dropdown (same pattern as the user menu below), not Metronic's
										     KTSearch/KTLayoutSearch component. KTLayoutSearch.init() in scripts.bundle.js
										     hard-wires itself to any element with id="kt_header_search" and non-defensively
										     binds click handlers on the demo's "preferences"/"advanced options" buttons --
										     since this app has no search backend and those panels were removed as fake
										     demo content, keeping that id would crash scripts.bundle.js on every page. --}}
										<!-- <div class="d-flex align-items-stretch ms-1 ms-lg-3">
											<div class="d-flex align-items-center" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px">
													<span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
															<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
														</svg>
													</span>
												</div>
											</div>
											<div class="menu menu-sub menu-sub-dropdown p-7 w-325px w-md-375px" data-kt-menu="true">
												<form class="w-100 position-relative" autocomplete="off">
													<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-0">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
															<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
														</svg>
													</span>
													<input type="text" class="form-control form-control-flush ps-10" name="search" value="" placeholder="Search..." />
												</form>
											</div>
										</div> -->
										<!--end::Search-->

										<!--begin::User-->
										<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
											<!--begin::Menu wrapper-->
											<div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
												<img src="{{ asset('assets/media/avatars/150-26.jpg') }}" alt="{{ auth()->user()->name }}" />
											</div>
											<!--begin::Menu-->
											<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
												<!--begin::Menu item-->
												<div class="menu-item px-3">
													<div class="menu-content d-flex align-items-center px-3">
														<!--begin::Avatar-->
														<div class="symbol symbol-50px me-5">
															<img alt="{{ auth()->user()->name }}" src="{{ asset('assets/media/avatars/150-26.jpg') }}" />
														</div>
														<!--end::Avatar-->
														<!--begin::Username-->
														<div class="d-flex flex-column">
															<div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->name }}</div>
														<span class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</span>
														</div>
														<!--end::Username-->
													</div>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu separator-->
												<div class="separator my-2"></div>
												<!--end::Menu separator-->
												<!--begin::Menu item-->
												<div class="menu-item px-5">
													<a href="{{ route('profile.edit') }}" class="menu-link px-5">My Profile</a>
												</div>
												<!--end::Menu item-->
												<!--begin::Menu separator-->
												<div class="separator my-2"></div>
												<!--end::Menu separator-->
												<!--begin::Menu item-->
												<div class="menu-item px-5">
													<a href="{{ route('logout') }}" class="menu-link px-5" onclick="event.preventDefault(); document.getElementById('kt-logout-form').submit();">Sign Out</a>
												<form id="kt-logout-form" method="POST" action="{{ route('logout') }}" class="d-none">@csrf</form>
												</div>
												<!--end::Menu item-->
											</div>
											<!--end::Menu-->
											<!--end::Menu wrapper-->
										</div>
										<!--end::User -->
									</div>
									<!--end::Toolbar wrapper-->
								</div>
		</div>
	</div>
</div>
