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
  .js('resources/js/profile.js', 'public/js')
  .js('resources/js/appsetting.js', 'public/js')
  //.copy('node_modules/ag-grid-community/dist/ag-grid-community.min.noStyle.js', 'public/js')
  //.js('resources/js/table-grid.js', 'public/js')
  //.js(['resources/js/flatpickr.js', 'node_modules/flatpickr/dist/flatpickr.js'], 'public/js') //Flatpicker
  //.js('resources/js/bootstrap.js', 'public/js')
  //.sass('resources/sass/bootstrap.scss', 'public/css')
  //.sass('resources/sass/fontawesome.scss', 'public/css')
  //.sass('resources/sass/flatpickr.scss', 'public/css') //style flatpiker
  //.sass('resources/sass/ag-grid-community.scss', 'public/css')
  //.sass('resources/sass/ag-theme-alpine.scss', 'public/css')
  .sass('resources/sass/app.scss', 'public/css');
