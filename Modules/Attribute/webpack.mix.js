let mix = require('laravel-mix');

mix.js('Modules/Attribute/Resources/assets/admin/js/main.js', 'Modules/Attribute/Assets/admin/js/attribute.js')
    .sass('Modules/Attribute/Resources/assets/admin/sass/main.scss', 'Modules/Attribute/Assets/admin/css/attribute.css');
