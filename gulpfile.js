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

elixir(function(mix) {
        mix.copy(
            'node_modules/angular-chart.js/dist/angular-chart.min.js',
            'public/js/libs'
        );
        mix.copy(
            'node_modules/chart.js/Chart.min.js',
            'public/js/libs'
        );
});
