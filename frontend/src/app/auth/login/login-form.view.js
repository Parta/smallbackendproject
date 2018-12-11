import $ from 'jquery';
import { View } from 'backbone.marionette';
import template from './login-form.hbs';
import authService  from '../auth.service';
import { History } from '../../history';


export default View.extend({
  template,

  ui: {
    loginForm: '.js-login-form',
  },

  events: {
    'submit @ui.loginForm': 'handleLoginSubmit',
  },

  state: {
    isLoading: false,
    username: null,
    error: null,
  },

  serializeData() {
    return this.state;
  },

  handleLoginSubmit(event) {
    event.preventDefault();
    const $form = $(event.currentTarget);
    const formData = $form.serializeArray();
    const credentials = {};

    formData.forEach((item) => {
      credentials[item.name] = item.value;
    });

    this.state.username = credentials.username;
    this.state.isLoading = true;
    this.state.error = null;
    this.render();

    authService
      .tryLogin(credentials)
      .then(() => {
        this.state.isLoading = false;
        this.state.username = null;
        this.state.error = null;

        History.navigate('/', true);
      })
      .catch(() => {
        this.state.error = true;
        this.state.username = credentials.username;
        this.state.isLoading = false;
        this.render();
      });

    return false;
  },
});
