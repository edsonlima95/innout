const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .styles('resources/views/web/assets/css/adminlte.min.css','public/frontend/assets/css/adminlte.min.css')
    .styles('resources/views/web/assets/css/fontawesome/css/all.min.css','public/frontend/assets/css/fontawesome/css/all.min.css')
    .styles('resources/views/web/assets/css/style-custom.css','public/frontend/assets/css/style-custom.css')
    .styles('resources/views/web/assets/css/dataTables.bootstrap4.min.css', 'public/frontend/assets/css/dataTables.bootstrap4.min.css')
    .styles('resources/views/web/assets/css/responsive.bootstrap4.min.css', 'public/frontend/assets/css/responsive.bootstrap4.min.css')

    .scripts('resources/views/web/assets/js/jquery.min.js','public/frontend/assets/js/jquery.min.js')
    .scripts('resources/views/web/assets/js/adminlte.min.js','public/frontend/assets/js/adminlte.min.js')
    .scripts('resources/views/web/assets/js/bootstrap.bundle.min.js','public/frontend/assets/js/bootstrap.bundle.min.js')

    .scripts('resources/views/web/assets/js/dataTables.bootstrap4.min.js', 'public/frontend/assets/js/dataTables.bootstrap4.min.js')
    .scripts('resources/views/web/assets/js/dataTables.responsive.min.js', 'public/frontend/assets/js/dataTables.responsive.min.js')
    .scripts('resources/views/web/assets/js/responsive.bootstrap4.min.js', 'public/frontend/assets/js/responsive.bootstrap4.min.js')
    .scripts('resources/views/web/assets/js/jquery.dataTables.min.js', 'public/frontend/assets/js/jquery.dataTables.min.js')

    .copyDirectory('resources/views/web/assets/css/fontawesome/webfonts', 'public/frontend/assets/css/fontawesome/webfonts')
    .copyDirectory('resources/views/web/assets/img', 'public/frontend/assets/img')

    .options({
        processCssUrls: false
    })

    .version();

