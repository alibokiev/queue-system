let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js').vue({
    options: {
        compilerOptions: {
            isCustomElement: (tag) => ['md-linedivider'].includes(tag),
        },
    }
})
    .sass('resources/sass/app.scss', 'public/css', []);
