import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // Skema warna Ultra-Modern
                green: colors.emerald,
                'blora-green-dark': '#064E3B',
                'blora-green':      '#059669',
                'blora-gold':       '#D97706',
                'blora-red':        '#E11D48',
                'blora-blue':       '#2563EB',
                'blora-cream':      '#F8FAFC',
                'blora-text':       '#0F172A',
            },
            fontFamily: {
                serif: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.serif],
                sans:  ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography],
};
