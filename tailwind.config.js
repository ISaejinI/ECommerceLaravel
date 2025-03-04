import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ], theme: {
        fontFamily: {
            display: ['Oswald', 'sans-serif'],
            body: ['Lato', 'sans-serif'],
        },
        extend: {
            colors: {
                cream: '#f6efe7',
                pink: '#f5bbb8',
                darkgreen: '#58612a',
                neutralgreen: '#989a35',
                lightgreen: '#e0e0a0'
            },
        },
    },

    plugins: [forms, typography],
};
