import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Ensure output is in the correct directory
        emptyOutDir: true, // Clear the directory before building
        manifest: 'manifest.json', // Place manifest in the root of the build directory
        chunkSizeWarningLimit: 2000, // Suppress warnings for large chunks
        rollupOptions: {
            output: {
                entryFileNames: '[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name].[ext]',
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        if (id.includes('tinymce')) {
                            return 'tinymce';
                        }
                        if (id.includes('swiper')) {
                            return 'swiper';
                        }
                        return 'vendor'; // Other node_modules go into "vendor"
                    }
                },
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'), // Adjust alias if needed
        },
    },
});
