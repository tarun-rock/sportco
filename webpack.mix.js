const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js',
        'public/js/modernizr.min.js',
        'public/js/lazysizes.min.js',
        'public/js/owl-carousel.min.js',
        'public/js/flickity.pkgd.min.js',
        'public/js/jquery.newsTicker.min.js',
        'public/js/jquery.sticky-kit.min.js',
        'public/js/sweetalert2.all.min.js',
        'public/js/jquery.timeago.js',
        'public/js/jquery.lazy.min.js',
        'public/js/main.js'
], 'public/js')
    .styles([
      'public/css/bootstrap4.min.css',
      'public/css/style.css',
      'node_modules/xzoom/src/xzoom.css',
      'public/css/all.css',
      'public/css/font-icons.css'
   ],'public/css/front.css');

mix.js('resources/js/post.js','public/js/post.js');
mix.js('resources/js/walletValidation.js','public/js/walletValidation.js');
mix.js('resources/js/products.js','public/js/products.js');

if (mix.inProduction()) {
    mix.version();
}