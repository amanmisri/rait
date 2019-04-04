let mix = require('laravel-mix');

mix.js('Modules/User/Resources/assets/admin/js/main.js', 'Modules/User/Assets/admin/js/user.js')
    .js('Modules/User/Resources/assets/admin/js/login.js', 'Modules/User/Assets/admin/js/login.js')
    .sass('Modules/User/Resources/assets/admin/sass/login.scss', 'Modules/User/Assets/admin/css/login.css')
    .sass('Modules/User/Resources/assets/admin/sass/main.scss', 'Modules/User/Assets/admin/css/user.css');
