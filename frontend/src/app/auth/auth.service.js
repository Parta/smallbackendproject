class AuthService {
  constructor() {
    this.storageKey = '__app_auth__';
    this.storage = localStorage;
  }

  authenticated() {
    return this.storage.getItem(this.storageKey);
  }

  login() {
    return this.storage.setItem(this.storageKey, JSON.stringify(true));
  }

  logout() {
    return this.storage.removeItem(this.storageKey);
  }
}

export default new AuthService();
