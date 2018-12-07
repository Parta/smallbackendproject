import { View } from 'backbone.marionette';
import { MonthlyMetrics } from "../monthly-metrics/monthly-metrics";
import { MonthlyChart } from "../monthly-chart/monthly-chart";

const MetricsContent = View.extend({
  className: 'metrics-content',

  template: require('./metrics-content.hbs'),

  regions: {
    monthlyPanels: '#app-metrics-monthly-panels',
    monthlyLineChart: '#app-metrics-monthly-chart',
  },

  onRender() {
    this.renderMonthlyMetrics();
    this.renderMonthlyChart();
  },

  renderMonthlyMetrics() {
    const metrics = new MonthlyMetrics();
    this.showChildView('monthlyPanels', metrics);
  },

  renderMonthlyChart() {
    this.showChildView('monthlyLineChart', new MonthlyChart());
  },
});

export { MetricsContent };
