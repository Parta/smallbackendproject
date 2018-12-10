import AppRouter from 'marionette.approuter';
import { AppController } from "./controller";
import authService  from "./auth/auth.service";

const Router = AppRouter.extend({
  controller: AppController,

  appRoutes: {
    '': 'index',
    'login': 'login',
    'app/metrics': 'metrics',
  },

  execute(callback, args, name) {
    if (name === 'login') {
      if (authService.authenticated()) {
        return this.navigate('/', { trigger: true });
      }

      return callback.apply(this, args);
    }

    if (!authService.authenticated()) {
      return this.navigate('login', { trigger: true });
    }

    if (callback) callback.apply(this, args);
  }
});

export { Router }
