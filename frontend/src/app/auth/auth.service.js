import Backbone from 'backbone';
import config from '../../config';

class AuthService {
  constructor() {
    this.storageTokenKey = '__app_auth_token__';
    this.storage = localStorage;
  }

  authenticated() {
    return this.hasAuthToken();
  }

  authToken() {
    return this.storage.getItem(this.storageTokenKey);
  }

  hasAuthToken() {
    return typeof this.authToken() === 'string';
  }

  storeToken(token) {
    this.storage.setItem(this.storageTokenKey, token);
  }

  removeToken() {
    this.storage.removeItem(this.storageTokenKey);
  }

  tryLogin(credentials) {
    return Backbone.$.ajax({
      url: config.baseUrl + '/login_check',
      method: 'post',
      data: JSON.stringify(credentials),
      contentType: "application/json",
    }).promise().then(response => {
      if (response.token) {
        this.storeToken(response.token);
      } else {
        this.removeToken();
      }

      return response;
    });
  }

  logout() {
    return this.removeToken();
  }
}

export default new AuthService();
