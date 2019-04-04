let mix = require('laravel-mix');

mix.js('Modules/Category/Resources/assets/admin/js/main.js', 'Modules/Category/Assets/admin/js/category.js')
    .scripts('Modules/Category/node_modules/jstree/dist/jstree.js', 'Modules/Category/Assets/admin/js/jstree.js')
    .sass('Modules/Category/Resources/assets/admin/sass/main.scss', 'Modules/Category/Assets/admin/css/category.css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/32px.png', 'Modules/Category/Assets/admin/css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/40px.png', 'Modules/Category/Assets/admin/css')
    .copy('Modules/Category/node_modules/jstree/dist/themes/default/throbber.gif', 'Modules/Category/Assets/admin/css');
