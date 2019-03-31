let mix = require('laravel-mix');

mix.js('Modules/Option/Resources/assets/admin/js/main.js', 'Modules/Option/Assets/admin/js/option.js')
    .sass('Modules/Option/Resources/assets/admin/sass/main.scss', 'Modules/Option/Assets/admin/css/option.css');
