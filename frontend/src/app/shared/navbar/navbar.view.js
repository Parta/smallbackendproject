import { View } from 'backbone.marionette';
import authService  from '../../auth/auth.service';
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
    authService.logout();
    History.navigate('/', true);
  },
});

export { NavbarView };
