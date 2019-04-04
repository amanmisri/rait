let mix = require('laravel-mix');

mix.js('Modules/Product/Resources/assets/admin/js/main.js', 'Modules/Product/Assets/admin/js/product.js')
    .sass('Modules/Product/Resources/assets/admin/sass/main.scss', 'Modules/Product/Assets/admin/css/product.css');
