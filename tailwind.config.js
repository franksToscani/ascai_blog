import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // Colori della bandiera del Camerun (logo dell'associazione)
            colors: {
                camerun: {
                    green: '#007A5E',
                    red: '#CE1126',
                    yellow: '#FCD116',
                },
            },
        },
    },

    plugins: [forms],
};
