import { View } from 'backbone.marionette';

const MetricsContent = View.extend({
  className: 'metrics-content',

  template: require('./metrics-content.hbs'),
});

export { MetricsContent };
