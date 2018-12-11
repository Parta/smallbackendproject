import { View } from 'backbone.marionette';

const Tooltip = View.extend({
  template: require('./tooltip.hbs'),
  data: {},

  initialize(data) {
    this.data = data;
  },

  serializeData() {
    return this.data;
  }
});

export { Tooltip };
