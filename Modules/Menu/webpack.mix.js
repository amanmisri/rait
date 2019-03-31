let mix = require('laravel-mix');

mix.js('Modules/Menu/Resources/assets/admin/js/main.js', 'Modules/Menu/Assets/admin/js/menu.js')
    .sass('Modules/Menu/Resources/assets/admin/sass/main.scss', 'Modules/Menu/Assets/admin/css/menu.css');
