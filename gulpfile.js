const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});

elixir(function(mix) {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    mix.sass('app.scss')
    .copy(bootstrapPath + '/fonts', 'public/fonts')
    .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js');

    var chartJsPath = 'node_modules/chart.js/dist';
    mix.copy(chartJsPath + '/Chart.min.js', 'public/js');
    
    mix.copy('resources/assets/js/jquery-3.1.1.min.js', 'public/js');
    mix.copy('resources/assets/js/jquery-ui.min.js', 'public/js');
    mix.copy('resources/assets/sass/jquery-ui.css', 'public/css');
    
});