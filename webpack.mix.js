const { mix } = require('laravel-mix');

mix.options({})
   .webpackConfig({
     module: {
       rules: [
         {
           test: /\.jsx?$/,
           exclude: /node_modules(?!\/@material)|bower_components/,
           use: [
             {
               loader: 'babel-loader',
               options: Config.babel()
             }
           ]
         }
       ]
     }
   })
   .sass('resources/assets/sass/app.scss', 'public/css', {
     includePaths: ['node_modules']
   })
   .js('resources/assets/js/app.js', 'public/js');

if (mix.config.inProduction) {
  mix.disableNotifications();
}
