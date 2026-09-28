{{--
    One shared "confirm delete" modal for the whole admin area, reused by every
    delete button. Trigger it from a plain button (no per-row modal markup needed):

    <button type="button" class="btn ..." data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
        data-kt-confirm-action="{{ route('admin.roles.destroy', $role) }}"
        data-kt-confirm-message='Delete the "{{ $role->name }}" role? This cannot be undone.'>
        Delete
    </button>

    The script below reads those data-kt-confirm-* attributes from whatever button
    opened the modal (Bootstrap passes it as event.relatedTarget) and points the
    modal's own delete form at that URL.
--}}
<div class="modal fade" id="kt_modal_confirm_delete" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-500px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<h2 class="fw-bolder">Please Confirm</h2>
				<div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
					<span class="svg-icon svg-icon-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
							<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
						</svg>
					</span>
				</div>
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body">
				<p id="kt_modal_confirm_delete_message" class="fs-5 text-gray-700 mb-0">Are you sure you want to delete this? This cannot be undone.</p>
			</div>
			<!--end::Modal body-->
			<!--begin::Modal footer-->
			<div class="modal-footer flex-center">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
				<form id="kt_modal_confirm_delete_form" method="POST" action="#">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Yes, delete it</button>
				</form>
			</div>
			<!--end::Modal footer-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>

<script>
	document.getElementById('kt_modal_confirm_delete')?.addEventListener('show.bs.modal', function (event) {
		const trigger = event.relatedTarget;
		if (!trigger) return;
		const action = trigger.getAttribute('data-kt-confirm-action');
		const message = trigger.getAttribute('data-kt-confirm-message');
		if (action) document.getElementById('kt_modal_confirm_delete_form').setAttribute('action', action);
		if (message) document.getElementById('kt_modal_confirm_delete_message').textContent = message;
	});
</script>
