import { CollectionView } from 'backbone.marionette';
import { MetricPanel } from '../../../shared/metric-panel/metric-panel.view';
import { MetricsCollection } from '../../collection/metrics-collection';
import { BrandCollections } from '../../collection/brands-collection';
import { BrandsMetricsCollection } from '../../collection/brands-metrics-collection';
import { fromUnix } from '../../../utils/dateformat';

const MonthlyMetrics = CollectionView.extend({
  className: 'monthly-metrics',
  childView: MetricPanel,
  template: require('./monthly-metrics.hbs'),
  childViewContainer: '.js-metrics-children',
  collection: new MetricsCollection(),

  state: {
    isLoaded: false,
    metadata: null,
  },

  serializeData() {
    return {
      subtitle: this.state.metadata
        && fromUnix(this.state.metadata.endDate, 'MMMM YYYY')
        || ''
    }
  },

  initialize() {
    const brands = new BrandCollections();
    const ids = brands.map(model => model.get('id'));
    this.metricsCollection = new BrandsMetricsCollection();
    this.metricsCollection.fetch({
      data: {
        interval: 'month',
        ids: ids.join(',')
      }
    }).then((response) => {
      this.state.isLoaded = true;
      this.state.metadata = response.metadata;
      this.render();
    })
  },

  onRender() {
    this.mapMetrics();
  },

  mapMetrics() {
    this.collection.reset(this.metricsCollection.map(model => {
      const metric = model.get('metrics').pop();

      return {
        brandName: model.get('brand').name,
        from: fromUnix(metric.startDate),
        to: fromUnix(metric.endDate),
        value: metric.value,
      }
    }));
  }
});

export { MonthlyMetrics };
