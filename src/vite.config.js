import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "public/css/app.css",
                "public/js/app.jsx",
                "public/js/register.js",
                "public/js/pages/index.jsx",
                "public/js/pages/login.jsx",
                "public/js/pages/register.jsx",
                "public/js/pages/movie.index/movie.index.jsx",
                "public/js/pages/movies.index/movies.index.jsx",
                "public/js/pages/movie.index/contants.js",
                "public/js/pages/movie.index/movie-comment.jsx",
                "public/js/pages/movie.index/movie-comments-context.jsx",
                "public/js/pages/movie.index/movie-comments-section.jsx",
                "public/js/pages/movie.index/movie-header.jsx",
                "public/js/pages/movie.index/movie-info-item.jsx",
                "public/js/pages/movie.index/movie-pill.jsx",
                "public/js/pages/movie.index/movie-poster.jsx",
                "public/js/pages/movie.index/movie-tab-button.jsx",
                "public/js/pages/movie.index/movie-tab-casts-section.jsx",
                "public/js/pages/movie.index/movie-tab-comments-section.jsx",
                "public/js/pages/movie.index/movie-tab-section.jsx",
                "public/js/pages/movie.index/movie-tab.jsx",
                "public/js/pages/movie.index/movie-watchlist-button.jsx",
            ],
            refresh: true,
        }),
        {
            name: "blade",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
        react(),
    ],
});
