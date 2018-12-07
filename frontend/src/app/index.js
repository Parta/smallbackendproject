import Marionette from 'backbone.marionette';
import { AuthLayout } from './auth/auth.layout';

const Application = Marionette.Application.extend({
  region: '#root',

  onStart() {
    this.showView(new AuthLayout());
  }
});

document.addEventListener('DOMContentLoaded',() => {
  const app = new Application();
  app.start();
});
