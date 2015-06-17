var elixir = require('laravel-elixir');

var paths = {
    'bootstrap': './public/bower/bootstrap-sass/assets/'
}

elixir(function(mix) {
    //mix.sass('app.scss');
    mix.sass("style.scss", 'public/css/', {includePaths: [paths.bootstrap + 'stylesheets/']});

    mix.styles([
    	'jquery-ui.min.css',
    	'yamm.css',
    	'extralayers.css',
    	'flexslider.css',
    	'style.css',
    ], 'public/css/everything.css', 'public/css/');
    // mix.browserify('app.js');
});

console.log(elixir);