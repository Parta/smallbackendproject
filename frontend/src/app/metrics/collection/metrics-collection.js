import { Collection } from 'backbone';
import { MetricsModel } from '../model/metrics-model';

const MetricsCollection = Collection.extend({
  model: MetricsModel,
});

export { MetricsCollection };
