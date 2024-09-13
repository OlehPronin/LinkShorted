import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/login.css',
                'resources/css/dashboard.css',
                'resources/css/profile.css',
                'resources/js/app.js',
                'resources/css/shorten.css',
                'resources/css/contact.css'
            ],
            refresh: true,
        }),
    ],
});
