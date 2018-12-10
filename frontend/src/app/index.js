import Marionette from 'backbone.marionette';
import { Router } from './router';
import { History } from './history';

const Application = Marionette.Application.extend({
  region: '#root',

  onStart(app, options) {
    this.router = new Router(options);

    History.start();
  },
});

document.addEventListener('DOMContentLoaded', () => {
  window.app = new Application();
  app.start();
});
