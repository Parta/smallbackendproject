import { View } from 'backbone.marionette';
import { NavbarView } from '../shared/navbar/navbar.view';
import { MetricsContent } from './metrics-content/metrics-content';

const MetricsLayout = View.extend({
  className: 'metrics-layout',

  template: require('./metrics.layout.hbs'),

  regions: {
    header: '#app-metrics-header',
    main: '#app-metrics-main',
    footer: '#app-metrics-header'
  },

  onRender() {
    this.showChildView('header', new NavbarView());
    this.showChildView('main', new MetricsContent());
  },
});

export { MetricsLayout };
