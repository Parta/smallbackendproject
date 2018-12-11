let config;
if (ENV === 'production') {
  config = require('./prod');
} else {
  config = require('./dev');
}

export default config.default;
