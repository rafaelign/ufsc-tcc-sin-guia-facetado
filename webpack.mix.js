let mix = require('laravel-mix');

mix
    .js('resources/assets/js/app.js', 'public/js')
    .scripts([
        'node_modules/bulma-modal-fx/dist/js/modal-fx.js'
    ], 'public/js/vendor.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'node_modules/bulma-modal-fx/dist/css/modal-fx.css'
    ], 'public/css/vendor.css')
    .copy('resources/assets/images', 'public/images')
    .copy('node_modules/bulma-modal-fx/dist/css/modal-fx.css.min.map', 'public/css/modal-fx.css.min.map')
    .options({
        fileLoaderDirs: {
            fonts: 'guia/fonts'
        }
    });

mix
    .js('resources/assets/js/admin.js', 'public/js')
    .sass('resources/assets/sass/admin.scss', 'public/css');
