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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
//mix client
mix.scripts([
    'public/assets/js/jquery.min.js',
    'public/assets/js/clipboard.min.js',
    'public/assets/js/bootstrap.bundle.min.js',
    'public/assets/js/adminlte.js',
    'public/assets/js/toastr.min.js',
    'public/assets/js/sweetalert2.min.js',
    'public/assets/js/jquery.validate.min.js',
    'public/assets/js/select2.full.min.js',
    'public/assets/js/jquery.dataTables.min.js',
    'public/assets/js/dataTables.bootstrap4.min.js',
    'public/assets/js/dataTables.responsive.min.js',
    'public/assets/js/responsive.bootstrap4.min.js',
    'public/assets/js/dataTables.buttons.min.js',
    'public/assets/js/buttons.bootstrap4.min.js',
    'public/assets/js/jszip.min.js',
    'public/assets/js/pdfmake.min.js',
    'public/assets/js/vfs_fonts.js',
    'public/assets/js/buttons.html5.min.js',
    'public/assets/js/buttons.print.min.js',
    'public/assets/js/jquery.overlayScrollbars.min.js',
    'public/assets/js/common.js',
    'public/assets/js/service.js',
], 'public/assets/js/jquery.main.js');

mix.styles([
    'public/assets/css/adminlte.min.css',
    'public/assets/css/toastr.min.css',
    'public/assets/css/icheck-bootstrap.min.css',
    'public/assets/css/sweetalert2.min.css',
    'public/assets/css/dataTables.bootstrap4.min.css',
    'public/assets/css/responsive.bootstrap4.min.css',
    'public/assets/css/buttons.bootstrap4.min.css',
    'public/assets/css/select2.min.css',
    'public/assets/css/select2-bootstrap4.min.css',
    'public/assets/css/OverlayScrollbars.min.css',
    'public/assets/css/app.css',
], 'public/assets/css/main.min.css');