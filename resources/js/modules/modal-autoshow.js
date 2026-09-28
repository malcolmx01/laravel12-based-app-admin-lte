/*
 * Opens any Bootstrap modal marked data-show-on-load when the page loads -- e.g. the
 * Profile "Delete account" modal after its password check failed validation.
 *
 * Uses the window.bootstrap exposed by adminlte-theme.js (loaded first by the app
 * layout) rather than importing Bootstrap, so app.js doesn't carry a second copy.
 */
document.querySelectorAll('.modal[data-show-on-load]').forEach((el) => window.bootstrap?.Modal.getOrCreateInstance(el).show());
