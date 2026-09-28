{{--
    One shared "confirm delete" modal for the whole admin area, reused by every
    delete button. Trigger it from a plain button (no per-row modal markup needed):

    <button type="button" class="btn ..." data-bs-toggle="modal" data-bs-target="#kt_modal_confirm_delete"
        data-kt-confirm-action="{{ route('admin.roles.destroy', $role) }}"
        data-kt-confirm-message='Delete the "{{ $role->name }}" role? This cannot be undone.'
        data-kt-confirm-button="Delete role">
        Delete
    </button>

    resources/js/modules/confirm-delete.js reads those data-kt-confirm-* attributes
    from whatever button opened the modal and points the delete form at that URL.
--}}
<div class="modal fade" id="kt_modal_confirm_delete" tabindex="-1" aria-labelledby="kt_modal_confirm_delete_title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title fs-5" id="kt_modal_confirm_delete_title">Confirm deletion</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p id="kt_modal_confirm_delete_message" class="mb-0">Are you sure you want to delete this? This cannot be undone.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
				<form id="kt_modal_confirm_delete_form" method="POST" action="#">
					@csrf
					@method('DELETE')
					<button type="submit" id="kt_modal_confirm_delete_submit" class="btn btn-danger" data-submitting-text="Deleting…">Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
