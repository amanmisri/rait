let mix = require('laravel-mix');

mix.js('Modules/Slider/Resources/assets/admin/js/main.js', 'Modules/Slider/Assets/admin/js/slider.js')
    .sass('Modules/Slider/Resources/assets/admin/sass/main.scss', 'Modules/Slider/Assets/admin/css/slider.css');
