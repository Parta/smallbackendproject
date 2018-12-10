let config;
if (process.NODE_ENV === 'production') {
  config = require('./prod');
} else {
  config = require('./dev');
}

export default config.default;
