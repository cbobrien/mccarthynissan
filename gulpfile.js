var elixir = require('laravel-elixir');

elixir(function(mix) {
    //mix.sass('app.scss');
    mix.browserify('app.js');
});

console.log(elixir);