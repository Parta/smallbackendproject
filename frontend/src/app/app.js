import Marionette from 'backbone.marionette';
import { Router } from './router';
import { History } from './history';
import './bootstrap';

const Application = Marionette.Application.extend({
  region: '#root',

  onStart(app, options) {
    this.router = new Router(options);
    History.start();
  },
});

export default new Application();
