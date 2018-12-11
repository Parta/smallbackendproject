const webpack = require('webpack');
const path = require('path');
const config = require('./config');
const mode = require('./lib/mode');

const publicPath = config.browserSync.proxy.target
  ? config.browserSync.proxy.publicPath
  : path.join('/', config.js.dist);

const webpackConfig = {
  context: path.resolve(config.root.src),
  entry: {
    app: [
      './app/index.js',
    ],
  },
  output: {
    path: path.resolve(config.root.dist, config.js.dist),
    filename: 'bundle.js',
    publicPath,
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: path.resolve(__dirname, 'node_modules/'),
        loader: 'babel-loader',
        options: {
          presets: [
            [
              'env',
            ],
          ],
        },
      }, {
        test: /\.hbs/,
        loader: 'handlebars-loader'
      }
    ],
  },
  plugins: [
    new webpack.DefinePlugin({
      ENV: JSON.stringify(process.env.NODE_ENV),
    })
  ],
};

/**
 * Modify webpackConfig depends on mode
 */
if (mode.production) {
  webpackConfig.plugins.push(
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false,
      },
    }),
    new webpack.NoEmitOnErrorsPlugin(),
  );
} else {
  webpackConfig.devtool = 'inline-source-map';
  webpackConfig.entry.app.unshift('webpack-hot-middleware/client?reload=true');
  webpackConfig.plugins.push(new webpack.HotModuleReplacementPlugin());
}

module.exports = webpackConfig;
