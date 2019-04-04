let mix = require('laravel-mix');

mix.js('Modules/Translation/Resources/assets/admin/js/main.js', 'Modules/Translation/Assets/admin/js/translation.js')
    .styles([
        'Modules/Translation/node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    ], 'Modules/Translation/Assets/admin/css/translation.css')
    .copy('Modules/Translation/node_modules/x-editable/dist/bootstrap3-editable/img', 'Modules/Translation/Assets/admin/img');
