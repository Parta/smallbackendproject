import { View } from 'backbone.marionette';
import { LineChart } from "../../../shared/line-chart/line-chart";
import * as d3 from "d3";

const MonthlyChart = View.extend({
  template: require('./monthly-chart.hbs'),

  regions: {
    chartContainer: '.js-region-chart'
  },

  onRender() {
    const data = {
      width: 1100,
      height: 500,
      title: 'Offline Volume Score',
      datasets: [
        d3.range(10).map(function(d) {
          return {
            value: d3.randomUniform(100)()
          }
        }),
        d3.range(10).map(function(d) {
          return {
            value: d3.randomUniform(100)()
          }
        }),
      ],
    };

    this.showChildView('chartContainer', new LineChart(data))
  }
});

export { MonthlyChart };
