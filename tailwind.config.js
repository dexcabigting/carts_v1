const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        
    ],

    theme: {
        extend: {
            colors: {
                'custom-black': '#171717',
                'custom-blacki': '#242424',
                'custom-violet': '#470CAF',
                'custom-text': '#292929',
                'custom-gray': '#262626',
              },
        },
    },

    variants: {
        extend: {
           
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
