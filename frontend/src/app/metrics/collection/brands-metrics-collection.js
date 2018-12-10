import { Collection } from 'backbone';
import { BrandMetricsModel } from '../model/brand-metrics-model';
import config from "../../../config";

const BrandsMetricsCollection = Collection.extend({
  model: BrandMetricsModel,

  url: `${config.baseUrl}/metric-values/`,

  parse(response) {
    return response.data;
  }
});

export { BrandsMetricsCollection };
