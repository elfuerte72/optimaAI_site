import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/js/services/index.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    // ВАЖНО: Не меняйте эти порты! Они зафиксированы для проекта.
    // Laravel сервер работает на порту 8000 (APP_URL в .env)
    server: {
        port: 8011,
        host: '127.0.0.1',
        hmr: {
            host: '127.0.0.1',
            protocol: 'ws',
            port: 8011,
            clientPort: 8011,
            timeout: 120000,
            overlay: false  // Отключаем overlay с ошибками
        },
    },
    build: {
        sourcemap: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    'gsap-vendor': ['gsap'],
                    'app-core': ['resources/js/app.js'],
                    'services': ['resources/js/services/index.js'],
                    'vue': ['vue'],
                },
            },
        },
    },
    resolve: {
        alias: {
            '@': '/resources/js',
            'vue': 'vue/dist/vue.esm-bundler.js',
        },
    },
});
