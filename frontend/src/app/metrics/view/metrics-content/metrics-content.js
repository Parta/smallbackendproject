import { View } from 'backbone.marionette';
import { MonthlyMetrics } from '../monthly-metrics/monthly-metrics';
import { BrandsWeeklyMetrics } from '../brands-weekly-metrics/brands-weekly-metrics';
import { WeeklyChart } from '../weekly-chart/weekly-chart';
import { MonthlyChart } from '../monthly-chart/monthly-chart';

const MetricsContent = View.extend({
  className: 'metrics-content',

  template: require('./metrics-content.hbs'),

  regions: {
    monthlyPanels: '#app-metrics-monthly-panels',
    weeklyMetrics: '#app-metrics-weekly-metrics',
    monthlyLineChart: '#app-metrics-monthly-chart',
    weeklyLineChart: '#app-metrics-weekly-chart',
  },

  onRender() {
    this.renderMonthlyMetrics();
    this.renderWeeklyMetrics();
    this.renderMonthlyChart();
    this.renderWeeklyChart();
  },

  renderMonthlyMetrics() {
    this.showChildView('monthlyPanels', new MonthlyMetrics());
  },

  renderMonthlyChart() {
    this.showChildView('monthlyLineChart', new MonthlyChart());
  },

  renderWeeklyMetrics() {
    this.showChildView('weeklyMetrics', new BrandsWeeklyMetrics());
  },

  renderWeeklyChart() {
    this.showChildView('weeklyLineChart', new WeeklyChart());
  },
});

export { MetricsContent };
