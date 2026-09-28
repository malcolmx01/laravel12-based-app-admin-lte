These files are Metronic's precompiled global-scope theme scripts
(originally `assets/js/scripts.bundle.js` and `assets/plugins/global/plugins.bundle.js`
in the demo). They are UMD/webpack bundles that expect classic `<script>` execution (so
their globals attach to `window`) and, in the case of plugins.bundle.js, contain UMD
wrappers with runtime `typeof module` / `require(...)` feature-detection meant for a
bundler or plain <script> tag -- not for re-bundling through Vite/Rollup as an ES module.
Running them through Vite's JS pipeline caused two real runtime errors (`require is not
defined`, then a cascading `Cannot read properties of undefined (reading 'data')` in
scripts.bundle.js once plugins.bundle.js's UMD detection blew up).

So: Metronic's CSS (style.bundle.css, plugins.bundle.css) is compiled by Vite as usual (see
vite.config.js) but these JS files are served as static passthrough assets and included
with plain, non-module <script src> tags in resources/views/layouts/guest.blade.php. The
pre-copy source lives at resources/js/metronic/ for reference/diffing against the original demo.

Only the guest/auth layout still uses Metronic. The authenticated app layout
(layouts/app.blade.php) is AdminLTE 4; its list pages use server-side search and
pagination, so Metronic's DataTables bundle was removed.
