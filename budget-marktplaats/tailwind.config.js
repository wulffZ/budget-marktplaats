const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    "primary": "#2d3b4d",
                    "secondary": "#EDA566",
                    "accent": "#1FB2A6",
                    "neutral": "#191D24",
                    "base-100": "#2A303C",
                    "info": "#3ABFF8",
                    "success": "#36D399",
                    "warning": "#FBBD23",
                    "error": "#F87272",
                },
            },
        ],
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require("daisyui")],
};
