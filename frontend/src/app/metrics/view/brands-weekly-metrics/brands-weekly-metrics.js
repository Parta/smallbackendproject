import $ from 'jquery';
import { View } from 'backbone.marionette';
import { BrandCollections } from '../../collection/brands-collection';
import { WeeklyMetrics } from '../weekly-metrics/weekly-metrics';
import { MetricsCollection } from '../../collection/metrics-collection';
import { BrandsMetricsCollection } from '../../collection/brands-metrics-collection';
import { fromUnix } from '../../../utils/dateformat';

const BrandsWeeklyMetrics = View.extend({
  className: 'brands-weekly-metrics',
  template: require('./brands-weekly-metrics.hbs'),
  collection: new BrandsMetricsCollection(),

  ui: {
    'metricsWrapper': '.js-metrics-wrapper'
  },

  state: {
    matadata: {},
    isLoaded: false,
  },

  initialize() {
    const brands = new BrandCollections();
    const ids = brands.map(model => model.get('id'));
    this.collection.fetch({
      data: {
        inverval: 'week',
        ids: ids.join(',')
      }
    }).then((response) => {
      this.state = {
        metadata: response.metadata,
        isLoaded: true
      };
      this.render();
    })
  },

  onRender() {
    if (this.state.isLoaded) {
      this.renderMetrics();
    }
  },

  renderMetrics() {
    const $wrapper = $(this.ui.metricsWrapper).html('');

    this.collection.each(model => {
      const weeklyView = new WeeklyMetrics({
        brand: model.get('brand'),
        metric: {
          name: 'Offline Volume Score',
          from: fromUnix(this.state.metadata.startDate),
          to: fromUnix(this.state.metadata.endDate)
        },
        collection: new MetricsCollection(
          model.get('metrics').map(metric => {
            return {
              from: fromUnix(metric.startDate),
              to: fromUnix(metric.endDate),
              value: metric.value,
            }
          })
        )
      });
      $wrapper.append(weeklyView.render().$el);
    });
  }
});

export { BrandsWeeklyMetrics };
