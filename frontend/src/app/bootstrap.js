import Backbone from 'backbone';
import authService from './auth/auth.service';

Backbone.$.ajaxSetup({
  beforeSend(xhr) {
    if (authService.hasAuthToken()) {
      xhr.setRequestHeader('Authorization', `Bearer ${authService.authToken()}`)
    }
  }
});
