import { History } from './history';

const AppController = {
  index() {
    History.navigate('app/metrics', true);
  },

  login() {
    const { AuthLayout } = require('./auth/auth.layout');

    app.showView(new AuthLayout());
  },

  metrics() {
    const { MetricsLayout } = require('./metrics/metrics.layout');

    app.showView(new MetricsLayout());
  },
};

export { AppController };

