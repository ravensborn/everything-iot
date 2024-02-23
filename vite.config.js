import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';

const host = 'timenet-project.test';

export default defineConfig({
    server: {
        host,
        hmr: { host },
        https: {
            key: fs.readFileSync('C:/laragon/etc/ssl/laragon.key'),
            cert: fs.readFileSync('C:/laragon/etc/ssl/laragon.crt'),
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/themes/front/src/assets/scss/theme.scss',

                //This was in theme.scss but caused hot reload time, temporarily we'll load it here.
                'resources/themes/front/src/assets/scss/_user.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        })
    ],
});
