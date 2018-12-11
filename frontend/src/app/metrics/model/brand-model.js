import { Model } from 'backbone';

const BrandModel = Model.extend({
  defaults: {
    id: null,
    name: null,
  },
});

export { BrandModel };
