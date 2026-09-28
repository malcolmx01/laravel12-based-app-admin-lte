/*
 * Role create/edit: the "Select all" checkbox toggles every permission checkbox.
 */
document.getElementById('kt_roles_select_all')?.addEventListener('change', function (e) {
    document.querySelectorAll('.kt-role-permission-checkbox').forEach((cb) => cb.checked = e.target.checked);
});
