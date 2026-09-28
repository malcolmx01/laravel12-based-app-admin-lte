/*
 * Shared "confirm delete" modal (resources/views/components/confirm-delete-modal.blade.php).
 *
 * Reads the data-kt-confirm-* attributes from whatever button opened the modal
 * (Bootstrap passes it as event.relatedTarget) and points the modal's own delete
 * form at that URL.
 */
document.getElementById('kt_modal_confirm_delete')?.addEventListener('show.bs.modal', function (event) {
    const trigger = event.relatedTarget;
    if (!trigger) return;
    const action = trigger.getAttribute('data-kt-confirm-action');
    const message = trigger.getAttribute('data-kt-confirm-message');
    if (action) document.getElementById('kt_modal_confirm_delete_form').setAttribute('action', action);
    if (message) document.getElementById('kt_modal_confirm_delete_message').textContent = message;
});
