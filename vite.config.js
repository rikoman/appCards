import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/card/main.css',
                'resources/css/card/comment.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
