let mix = require('laravel-mix');

mix.js('Modules/Report/Resources/assets/admin/js/main.js', 'Modules/Report/Assets/admin/js/report.js')
    .sass('Modules/Report/Resources/assets/admin/scss/main.scss', 'Modules/Report/Assets/admin/css/report.css');
