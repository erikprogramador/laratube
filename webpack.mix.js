const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/@mdi/font/fonts', 'public/fonts')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')]
    })
