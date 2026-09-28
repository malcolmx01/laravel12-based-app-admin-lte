import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Laravel / Breeze
                'resources/css/app.css',
                'resources/js/app.js',
                // AdminLTE theme (vendor CSS/JS -- see the headers of these files).
                'resources/css/adminlte-theme.css',
                'resources/js/adminlte-theme.js',
                // App-level custom-property overrides of the theme (accessibility fixes).
                'resources/css/theme-overrides.css',
                // Metronic theme (guest/auth layout only) -- CSS only. The JS bundles are legacy
                // UMD/global-scope builds (not authored for ESM re-bundling); see
                // public/assets/js/metronic/README.md for why they're served as
                // plain static <script> tags instead of Vite entries.
                'resources/css/metronic/plugins/plugins.bundle.css',
                'resources/css/metronic/style.bundle.css',
            ],
            refresh: true,
        }),
    ],
});
