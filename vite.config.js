import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';



export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // Tagify
                'resources/sass/tagify.scss',
                'resources/js/tagify.js',

            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
