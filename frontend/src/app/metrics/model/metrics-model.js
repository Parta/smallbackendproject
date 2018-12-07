import { Model } from 'backbone';

const MetricsModel = Model.extend({
  defaults: {
    brandName: '',
    from: null,
    to: null,
    name: '',
    value: null,
  },
});

export { MetricsModel };
