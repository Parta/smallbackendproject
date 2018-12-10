import { Model } from 'backbone';

const BrandMetricsModel = Model.extend({
  defaults: {
    brand: {
      id: 70905,
      name: "7UP"
    },
    metrics: []
  },
});

export { BrandMetricsModel };
