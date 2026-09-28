/*
 * AdminLTE theme runtime (vendor wiring only -- no app logic here).
 *
 * Mirrors the <script> block at the bottom of AdminLTE 4.8.3's demo pages
 * (OverlayScrollbars, Popper, Bootstrap 5.3.8, adminlte.js), bundled through
 * Vite instead of loaded from the CDN. The package only ships the ES module
 * build (adminlte.esm.js), which initialises itself on DOMContentLoaded.
 *
 * App behaviour lives in resources/js/app.js and resources/js/modules/.
 */
import * as bootstrap from 'bootstrap';
import { OverlayScrollbars } from 'overlayscrollbars';
import './adminlte/adminlte.esm.js';

// Expose Bootstrap for any page script that needs its component API
// (e.g. bootstrap.Modal.getOrCreateInstance(...)).
window.bootstrap = bootstrap;

// Custom scrollbar on the sidebar, as in AdminLTE's demo pages. Skipped on
// small screens to avoid interfering with touch scrolling.
const sidebarWrapper = document.querySelector('.sidebar-wrapper');
if (sidebarWrapper && window.innerWidth > 992) {
    OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
            theme: 'os-theme-light',
            autoHide: 'leave',
            clickScroll: true,
        },
    });
}
