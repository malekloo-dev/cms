
let mix = require('laravel-mix');

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
    processCssUrls: false
});

var template = dotenv.parsed.TEMPLATE_NAME;

mix.setPublicPath('public/')
    .sass('resources/css/' + template + '.scss', '/' + template, {
        sassOptions: {
            strictMath: true
        }
    })
    .minify('public/' + template + '/' + template + '.css')
    .version();
