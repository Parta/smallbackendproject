class AuthService {
  constructor() {
    this.storageKey = '__app_auth__';
    this.storageTokenKey = '__app_auth_token__';
    this.storage = localStorage;
  }

  authenticated() {
    return this.storage.getItem(this.storageKey);
  }

  authToken() {
    return this.storage.getItem(this.storageTokenKey);
  }

  hasAuthToken() {
    return typeof this.authToken() === 'string';
  }

  login() {
    return this.storage.setItem(this.storageKey, JSON.stringify(true));
  }

  logout() {
    return this.storage.removeItem(this.storageKey);
  }
}

export default new AuthService();
