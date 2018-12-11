import { Model } from 'backbone';

const MetricsModel = Model.extend({
  defaults: {
    from: null,
    to: null,
    value: null,
  },
});

export { MetricsModel };
