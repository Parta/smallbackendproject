import { History } from './history';
import authService  from "./auth/auth.service";

const AppController = {
  index() {
    if (authService.authenticated()) {
      return History.navigate('app/metrics', true);
    }

    History.navigate('login', true);
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

