import AppRouter from 'marionette.approuter';
import { AppController } from "./controller";
import { AuthState } from "./auth/auth.state";
import { History } from "./history";

const Router = AppRouter.extend({
  controller: AppController,

  appRoutes: {
    '': 'index',
    'login': 'login',
    'app/metrics': 'metrics',
  },

  onRoute: function(name, path) {
    if (path === 'login' && AuthState.authenticated) {
      return History.navigate('/', true);
    }

    if (path.startsWith('app', 0) && !AuthState.authenticated) {
      return History.navigate('login', true);
    }
  }
});

export { Router }
