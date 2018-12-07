import { View } from 'backbone.marionette';

const MetricPanel = View.extend({
  className: 'metric-panel',

  template: require('./metric-panel.hbs'),
});

export { MetricPanel };
