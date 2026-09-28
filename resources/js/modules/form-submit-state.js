/*
 * Full-page form submits: disable the submitter, show a spinner and a status
 * message, and ignore repeat submits. Opt out with data-no-submit-state on the form.
 * Custom text: data-submitting-text="Deleting…" on the submit button.
 *
 * A disabled submitter is left out of the submitted data, so submit buttons in
 * this app must not carry a name/value.
 */
document.addEventListener('submit', (event) => {
    const form = event.target;
    if (!(form instanceof HTMLFormElement) || form.hasAttribute('data-no-submit-state')) return;
    if (form.method.toLowerCase() === 'get') return;
    if (form.dataset.submitting) {
        event.preventDefault();
        return;
    }
    form.dataset.submitting = 'true';

    const button = event.submitter ?? form.querySelector('[type="submit"]');
    if (!button) return;
    const status = document.createElement('span');
    status.className = 'visually-hidden';
    status.setAttribute('role', 'status');
    status.textContent = button.dataset.submittingText ?? 'Saving…';
    const spinner = document.createElement('span');
    spinner.className = 'spinner-border spinner-border-sm me-1';
    spinner.setAttribute('aria-hidden', 'true');
    button.disabled = true;
    button.prepend(spinner, status);
});

// The back/forward cache restores the page with the disabled button; reset it.
window.addEventListener('pageshow', (event) => {
    if (!event.persisted) return;
    document.querySelectorAll('form[data-submitting]').forEach((form) => {
        delete form.dataset.submitting;
        form.querySelectorAll('[type="submit"]').forEach((button) => {
            button.disabled = false;
            button.querySelectorAll('.spinner-border, [role="status"]').forEach((el) => el.remove());
        });
    });
});
