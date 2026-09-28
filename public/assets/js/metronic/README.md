These files are Metronic's precompiled global-scope theme scripts
(originally `assets/js/scripts.bundle.js`, `assets/plugins/global/plugins.bundle.js`,
and `assets/plugins/custom/datatables/datatables.bundle.js` in the demo). They are
UMD/webpack bundles that expect classic `<script>` execution (so their globals attach
to `window`) and, in the case of plugins.bundle.js, contain UMD wrappers with runtime
`typeof module` / `require(...)` feature-detection meant for a bundler or plain
<script> tag -- not for re-bundling through Vite/Rollup as an ES module. Running them
through Vite's JS pipeline caused two real runtime errors (`require is not defined`,
then a cascading `Cannot read properties of undefined (reading 'data')` in
scripts.bundle.js once plugins.bundle.js's UMD detection blew up).

So: Metronic's CSS (style.bundle.css, plugins.bundle.css, plugins/datatables/datatables.bundle.css)
is compiled by Vite as usual (see vite.config.js) but these JS files are served as static
passthrough assets and included with plain, non-module <script src> tags -- plugins.bundle.js
and scripts.bundle.js globally in resources/views/layouts/app.blade.php, datatables.bundle.js
only on the admin pages that use a DataTable (via the layout's `scripts` slot), exactly how
the original HTML demo loads them per-page. The pre-copy source for the two global bundles
lives at resources/js/metronic/ for reference/diffing against the original demo (datatables.bundle.js
was copied straight to public/ since it's already page-scoped, not a global entry).

datatables.bundle.js depends on jQuery, which plugins.bundle.js already loads as a global
(`window.jQuery`/`window.$`) -- so datatables.bundle.js must be included *after* plugins.bundle.js
in the DOM, which the `scripts` slot (rendered after the core bundles) guarantees.
