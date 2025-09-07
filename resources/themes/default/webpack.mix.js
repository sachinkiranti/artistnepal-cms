const mix = require('laravel-mix');

// Assets
mix.copyDirectory('resources/themes/default/assets/img', 'public/dist/themes/default/img');
mix.copyDirectory('resources/themes/default/assets/fonts', 'public/dist/themes/default/fonts');
// js
mix.js([
    'resources/themes/default/assets/js/hmk-grid.js',
    'resources/themes/default/assets/js/app.js',
    'resources/themes/default/assets/js/jquery.lazyload.min.js',
    'resources/themes/default/assets/js/custom.js'
], 'public/dist/themes/default/js/app.min.js');
// css
mix.styles([
    'resources/themes/default/assets/css/hmk-grid.css',
    'resources/themes/default/assets/css/app.css'
], 'public/dist/themes/default/css/app.min.css');

mix.js([
    'resources/themes/default/assets/js/single.js',
], 'public/dist/themes/default/js/single.min.js');

mix.js([
    'resources/themes/default/assets/js/archive.js',
], 'public/dist/themes/default/js/archive.min.js');

mix.styles([
    'resources/themes/default/assets/css/lightgallery.css',
], 'public/dist/themes/default/css/gallery.min.css');

mix.scripts([
    'resources/themes/default/assets/js/lightgallery-all.min.js',
    // 'resources/themes/default/assets/js/gallery.js',
], 'public/dist/themes/default/js/gallery.min.js');

mix.scripts([
    'resources/assets/js/client.min.js',
    'resources/themes/default/assets/js/feedback-manager.js',
], 'public/dist/themes/default/js/feedback-manager.min.js');

mix.scripts([
    'public/vendor/laravel-filemanager/js/stand-alone-button.js',
    'resources/themes/default/assets/js/customizer.js',
], 'public/dist/themes/default/js/customizer.min.js');
