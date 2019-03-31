let mix = require('laravel-mix');

mix.js('Modules/Tax/Resources/assets/admin/js/main.js', 'Modules/Tax/Assets/admin/js/tax.js')
    .sass('Modules/Tax/Resources/assets/admin/sass/main.scss', 'Modules/Tax/Assets/admin/css/tax.css');
