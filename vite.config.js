import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `
              @import "./src/styles/_animations.scss";
              @import "./src/styles/_variables.scss";
              @import "./src/styles/_mixins.scss";
              @import "./src/styles/_helpers.scss";
            `,
            },
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/style.css",
                "resources/css/components.css",
                "resources/js/app.js",
                "resources/react/message.jsx",
                "resources/react/notify.jsx",
                "resources/js/chartjs/Chart.bundle.min.js",
            ],
            refresh: true,
        }),
    ],
});
