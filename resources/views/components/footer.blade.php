{{-- Metronic footer. Ported from resources/metronic-source/demo1/dist/index.html.
     The original Keenthemes/Envato branding and marketing links (About/Support/Purchase)
     were replaced with a plain app copyright line -- see the Phase 5 report. --}}
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-center">
		<!--begin::Copyright-->
		<div class="text-dark">
			<span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
			<span class="text-gray-800">{{ config('app.name', 'Laravel') }}</span>
		</div>
		<!--end::Copyright-->
	</div>
	<!--end::Container-->
</div>
