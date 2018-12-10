import { Collection } from 'backbone';
import { BrandMetricsModel } from '../model/brand-metrics-model';
import config from "../../../config";

const BrandsMetricsCollection = Collection.extend({
  model: BrandMetricsModel,

  url: `${config.baseUrl}/metric-values/week/70905,70933`,

  parse(response) {
    return response.data;
  }
});

export { BrandsMetricsCollection };
