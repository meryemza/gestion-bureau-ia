import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                custom: {
                    dark: '#070E2A',
                    violet: '#AC72A1',
                    pink: '#FBD9FA',
                },
            },
            backgroundImage: {
                'violet-gradient': 'linear-gradient(135deg, #AC72A1, #FBD9FA)',
            },
            animation: {
                'fade-in-up': 'fadeInUp 0.6s ease-out both',
            },
            keyframes: {
                fadeInUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(20px)',
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
            },
        },
    },

    plugins: [forms],
};

