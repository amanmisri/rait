let mix = require('laravel-mix');

mix.js('Themes/Storefront/resources/assets/admin/js/main.js', 'Themes/Storefront/assets/admin/js/storefront.js')
    .js('Themes/Storefront/resources/assets/public/js/app.js', 'Themes/Storefront/assets/public/js/app.js')
    .js('Themes/Storefront/resources/assets/public/js/stripe.js', 'Themes/Storefront/assets/public/js/stripe.js')
    .sass('Themes/Storefront/resources/assets/admin/sass/main.scss', 'Themes/Storefront/assets/admin/css/storefront.css')
    .sass('Themes/Storefront/resources/assets/public/sass/app.scss', 'Themes/Storefront/assets/public/css/app.css')
    .copy('Themes/Storefront/resources/assets/public/js/jquery.tosrus.all.min.js', 'Themes/Storefront/assets/public/js/tosrus.js')
    .copy('Themes/Storefront/node_modules/font-awesome/fonts', 'Themes/Storefront/assets/public/fonts')
    .copy('Themes/Storefront/node_modules/slick-carousel/slick/fonts', 'Themes/Storefront/assets/public/css/fonts')
    .copy('Themes/Storefront/node_modules/slick-carousel/slick/ajax-loader.gif', 'Themes/Storefront/assets/public/css')
    .copy('Themes/Storefront/resources/assets/public/images', 'Themes/Storefront/assets/public/images')
    .copy('Themes/Storefront/resources/assets/public/images', 'Themes/Storefront/assets/public/images');
