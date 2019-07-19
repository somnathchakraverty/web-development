let mix = require('laravel-mix');

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


mix.styles([
    'resources/assets/css/v2/bootstrap.css',
    'resources/assets/css/v2/owl.carousel.min.css',
    'resources/assets/css/v2/bootstrap-select.css',
    'resources/assets/css/v2/select2.min.css',
    'resources/assets/css/v2/style.css',
    'resources/assets/css/v2/responsive.css'
], 'public/css/v2/app.css').version();

mix.styles([
    'public/css/t2/bootstrap.css',
    'public/css/t2/style.css',
    'public/css/t2/responsive.css'
], 'public/css/v2/head.css').version();

mix.styles([
    'public/css/t2/owl.carousel.min.css',
    'public/css/t2/bootstrap-select.css',
    'public/css/t2/select2.min.css'
], 'public/css/v2/footer.css').version();

mix.styles([
    'resources/assets/css/v2/bootstrap.css',    
    'resources/assets/css/v2/owl.carousel.min.css',
    'resources/assets/css/v2/bootstrap-select.css',
    'resources/assets/css/v2/select2.min.css',
    'resources/assets/css/v2/style.css',
    'resources/assets/css/v2/responsive.css'
], 'public/css/v2/search.css').version();

mix.js([        
    'resources/assets/js/v2/bootstrap.min.js',
    'resources/assets/js/v2/owl.carousel.min.js',
    'resources/assets/js/v2/bootstrap-datepicker.js',
    'resources/assets/js/v2/custom.js',
    'resources/assets/js/v2/jquery.lazyloadxt.min.js'
], 'public/js/v2/main.js').version();

mix.js([        
    
    'resources/assets/js/v2/bootstrap.min.js',
    'resources/assets/js/v2/owl.carousel.min.js',
    'resources/assets/js/v2/bootstrap-datepicker.js',
    'resources/assets/js/v2/bootstrap-select.js',
    'resources/assets/js/v2/custom.js',
    'resources/assets/js/v2/jquery.lazyloadxt.min.js'
], 'public/js/v2/app.js').version();


mix.js([
    'resources/assets/js/inner_page/index.js'
], 'public/js/v2/index.js').version();


if (mix.inProduction()) {
    mix.copyDirectory('public/css/v2',  'public/css/backup/build');
}