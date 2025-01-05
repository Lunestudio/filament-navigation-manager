import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/styles.css"],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'dist',
        rollupOptions: {
            output: {
                entryFileNames: "js/[name].js",
                chunkFileNames: "js/[name].js",
                assetFileNames: "css/[name][extname]",
            },
        },
    },
});
