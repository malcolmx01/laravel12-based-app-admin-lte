{{-- AdminLTE main sidebar (app-sidebar). Based on admin-lte/dist/starter.html.
     Active item: `nav-link active`; a parent whose child is active also gets
     `menu-open` on its <li> and `active` on its own link (AdminLTE convention). --}}
@php($adminOpen = request()->routeIs('admin.*'))
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
	<!--begin::Sidebar Brand-->
	<div class="sidebar-brand">
		<a href="{{ route('dashboard') }}" class="brand-link">
			<img src="{{ asset('assets/adminlte/img/AdminLTELogo.png') }}" alt="{{ config('app.name', 'Laravel') }} logo" class="brand-image opacity-75 shadow" />
			<span class="brand-text fw-light">{{ config('app.name', 'Laravel') }}</span>
		</a>
	</div>
	<!--end::Sidebar Brand-->
	<!--begin::Sidebar Wrapper-->
	<div class="sidebar-wrapper">
		<nav class="mt-2" aria-label="Main navigation">
			<ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
				<li class="nav-item">
					<a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
						<i class="nav-icon bi bi-speedometer"></i>
						<p>Dashboard</p>
					</a>
				</li>

				@role('Superadmin')
					<li class="nav-header">ADMINISTRATION</li>
					<li class="nav-item {{ $adminOpen ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ $adminOpen ? 'active' : '' }}">
							<i class="nav-icon bi bi-shield-lock"></i>
							<p>
								Access Control
								<i class="nav-arrow bi bi-chevron-right"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
									<i class="nav-icon bi bi-people"></i>
									<p>Users</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
									<i class="nav-icon bi bi-person-badge"></i>
									<p>Roles</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
									<i class="nav-icon bi bi-key"></i>
									<p>Permissions</p>
								</a>
							</li>
						</ul>
					</li>
				@endrole

				<li class="nav-header">ACCOUNT</li>
				<li class="nav-item">
					<a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
						<i class="nav-icon bi bi-person-circle"></i>
						<p>Profile</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
	<!--end::Sidebar Wrapper-->
</aside>
