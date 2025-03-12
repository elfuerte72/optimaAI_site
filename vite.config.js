import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/react-app.jsx'],
            refresh: true,
        }),
        tailwindcss(),
        react({
            jsxRuntime: 'automatic',
            include: '**/*.{jsx,js}',
        }),
    ],
    server: {
        port: 8000,
        host: '127.0.0.1',
        hmr: {
            host: '127.0.0.1',
            port: 8000
        },
    },
    build: {
        sourcemap: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    'react-vendor': ['react', 'react-dom', 'framer-motion'],
                    'app-core': ['resources/js/app.js'],
                    'react-app': ['resources/js/react-app.jsx'],
                },
            },
        },
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
});
