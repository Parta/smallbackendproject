import { Model } from 'backbone';

const BrandMetricsModel = Model.extend({
  defaults: {
    brand: {
      id: null,
      name: ''
    },
    metrics: []
  },
});

export { BrandMetricsModel };
