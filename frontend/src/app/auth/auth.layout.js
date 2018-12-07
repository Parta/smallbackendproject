import { View } from 'backbone.marionette';
import LoginView from './login/login-form.view';

const AuthLayout = View.extend({
  region: '#root',

  className: 'auth-layout',

  template: require('./auth.layout.hbs'),

  regions: {
    main: '#auth-main',
  },

  onRender() {
    this.showChildView('main', new LoginView());
  },
});

export { AuthLayout };
