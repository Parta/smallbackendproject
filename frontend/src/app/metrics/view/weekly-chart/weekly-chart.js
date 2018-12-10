import { View } from 'backbone.marionette';
import { LineChart } from '../../../shared/line-chart/line-chart';
import { Tooltip } from '../../../shared/line-chart/tooltip/tooltip';
import { BrandsMetricsCollection } from '../../collection/brands-metrics-collection';
import { fromUnix } from '../../../utils/dateformat';
import { BrandCollections } from '../../collection/brands-collection';

const WeeklyChart = View.extend({
  template: require('./weekly-chart.hbs'),

  regions: {
    chartContainer: '.js-region-chart'
  },

  state: {
    isLoaded: false,
  },

  initialize() {
    const brands = new BrandCollections();
    const ids = brands.map(model => model.get('id'));
    this.collection = new BrandsMetricsCollection();
    this.collection.fetch({
      data: {
        interval: 'week',
        ids: ids.join(',')
      }
    }).then(() => {
      this.state.isLoaded = true;
      this.render();
    })
  },

  onRender() {
    if (this.state.isLoaded) {
      this.renderWeeklyChart()
    }
  },

  renderWeeklyChart() {
    const data = {
      title: 'Offline Volume Score (Weekly)',
      subtitle: '27 Aug 2018 - 30 Sept 2018',
      datasets: this.collection.map((model) => {
        return {
          label: model.get('brand').name,
          data: model.get('metrics').map(metric => {
            return {
              from: metric.startDate,
              to: metric.endDate,
              value: metric.value
            }
          })
        }
      }),
      tooltipHtml: (selectedItem, selectedValues) => {
        const item = Object.assign({}, selectedItem, {
          from: fromUnix(selectedItem.from),
          to: fromUnix(selectedItem.to),
        });
        const tooltipView = new Tooltip({ item, selectedValues });
        return tooltipView.render().$el.html();
      }
    };

    this.showChildView('chartContainer', new LineChart(data))
  }
});

export { WeeklyChart };
