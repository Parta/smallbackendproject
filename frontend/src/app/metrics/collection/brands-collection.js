import { Collection } from 'backbone';
import { BrandModel } from '../model/brand-model';

const BrandCollections = Collection.extend({
  model: BrandModel,

  initialize() {
    this.reset([
      {
        id: 70905,
        name: '7UP',
      },
      {
        id: 70933,
        name: 'A&W Root Beer',
      }
    ]);
  }
});

export { BrandCollections };
