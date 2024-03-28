
let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
var LiveReloadPlugin = require('webpack-livereload-plugin');

const path = require("path");

const dotenv = require('dotenv').config({
    path: path.join(__dirname, '.env')
});


mix.webpackConfig({
    plugins: [new LiveReloadPlugin()],
    stats: {
        children: true
    }
});

mix.options({
    processCssUrls: false,
    postCss: [tailwindcss('./tailwind.config.js')],
});

var template = dotenv.parsed.TEMPLATE_NAME;

mix.setPublicPath('public/' + template + '/')
    .sass('resources/css/' + template + '.scss', '/', {
        sassOptions: {
            strictMath: true
        }
    })
    .copy(
        'resources/fonts',
        'public/' + template + '/fonts'
    )
    .sass('resources/css/panel.scss', 'panel')

    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts/',
        'public/' + template + '/panel/webfonts/'
    )
    .copy(
        'resources/js/jquery-3.6.0.min.js',
        'public/' + template + '/'
    )
    // .minify('public/'+template + '/'+template + '.css')
    .version();

