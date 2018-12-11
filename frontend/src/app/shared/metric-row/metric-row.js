import { View } from 'backbone.marionette';

const MetricRow = View.extend({
  className: 'metric-row',

  template: require('./metric-row.hbs'),
});

export { MetricRow };
