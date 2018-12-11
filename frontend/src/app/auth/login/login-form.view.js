import { View } from 'backbone.marionette';
import template from './login-form.hbs';
import authService  from '../auth.service';
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
    authService.login();
    History.navigate('/', true);
  },
});
