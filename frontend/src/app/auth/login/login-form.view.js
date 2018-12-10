import { View } from 'backbone.marionette';
import template from './login-form.hbs';
import { AuthState } from '../auth.state';
import { History } from '../../history';

export default View.extend({
  template,

  ui: {
    loginButton: '.js-login',
  },

  events: {
    'click @ui.loginButton': 'handleLoginClick',
  },

  handleLoginClick() {
    AuthState.authenticated = true;
    History.navigate('/', true);
  },
});
