import { CollectionView } from 'backbone.marionette';
import { MetricPanel } from '../../../shared/metric-panel/metric-panel.view';
import { MetricsCollection } from '../../collection/metrics-collection';

const MonthlyMetrics = CollectionView.extend({
  className: 'monthly-metrics',
  childView: MetricPanel,
  template: require('./monthly-metrics.hbs'),
  childViewContainer: '.js-metrics-children',
  collection: new MetricsCollection(),

  initialize() {
    this.collection.reset([
      {
        brandName: '7UP',
        from: 1,
        to: 2,
        name: 'Offline Score Volume',
        value: 70,
      },
      {
        brandName: 'A&W',
        from: null,
        to: null,
        name: 'Offline Score Volume',
        value: 60,
      }
    ]);
  }
});

export { MonthlyMetrics };
