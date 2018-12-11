import { CollectionView } from 'backbone.marionette';
import { MetricRow } from '../../../shared/metric-row/metric-row';

const WeeklyMetrics = CollectionView.extend({
  className: 'weekly-metrics',
  childView: MetricRow,
  template: require('./weekly-metrics.hbs'),
  childViewContainer: '.js-metrics-children',

  data: {
    brand: null,
    metric: null,
  },

  initialize({ brand, metric }) {
    this.data = {
      brand,
      metric
    };
  },

  serializeData() {
    return {
      brand: this.data.brand,
      metric: this.data.metric,
    }
  }
});

export { WeeklyMetrics };
