import { View } from 'backbone.marionette';
import { AuthState } from '../../auth/auth.state';
import { History } from '../../history';

const NavbarView = View.extend({
  className: 'navbar-view',

  template: require('./navbar.view.hbs'),

  ui: {
    logoutButton: '.js-logout',
  },

  events: {
    'click @ui.logoutButton': 'handleLogoutClick',
  },

  handleLogoutClick() {
    AuthState.authenticated = false;
    History.navigate('/', true);
  },
});

export { NavbarView };
