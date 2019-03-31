let mix = require('laravel-mix');

mix.js('Modules/Media/Resources/assets/admin/js/main.js', 'Modules/Media/Assets/admin/js/media.js')
    .sass('Modules/Media/Resources/assets/admin/sass/main.scss', 'Modules/Media/Assets/admin/css/media.css');
