const mix = require('laravel-mix');

// Assets
mix.copyDirectory('resources/themes\artist-nepal\assets\img', 'public\dist/themes\artist-nepal\img');
// js
mix.js([
    'resources/themes\artist-nepal\assets\js\app.js'
], 'public\dist/themes\artist-nepal\js\app.min.js')
// css
mix.styles([
    'resources/themes\artist-nepal\assets\css\app.css'
], 'public\dist/themes\artist-nepal\css\app.min.css');
