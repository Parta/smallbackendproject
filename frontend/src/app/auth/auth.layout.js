import { View } from 'backbone.marionette';
import LoginView from './login/login-form.view';

const AuthLayout = View.extend({
  className: 'auth-layout',

  template: require('./auth.layout.hbs'),

  regions: {
    header: '#auth-header',
    main: '#auth-main',
    footer: '#auth-footer'
  },

  onRender() {
    this.showChildView('main', new LoginView());
  }
});

export { AuthLayout };
