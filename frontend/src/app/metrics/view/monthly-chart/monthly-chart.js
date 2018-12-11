import { View } from 'backbone.marionette';
import { LineChart } from '../../../shared/line-chart/line-chart';
import { Tooltip } from '../../../shared/line-chart/tooltip/tooltip';
import { fromUnix } from '../../../utils/dateformat';
import { BrandsMetricsCollection } from '../../collection/brands-metrics-collection';
import { BrandCollections } from '../../collection/brands-collection';

const MonthlyChart = View.extend({
  template: require('./monthly-chart.hbs'),

  regions: {
    chartContainer: '.js-region-chart'
  },

  state: {
    isLoaded: false,
    metadata: {},
  },

  initialize() {
    const brands = new BrandCollections();
    const ids = brands.map(model => model.get('id'));
    this.collection = new BrandsMetricsCollection();
    this.collection.fetch({
      data: {
        interval: 'month',
        ids: ids.join(',')
      }
    }).then((response) => {
      this.state.isLoaded = true;
      this.state.metadata = response.metadata;
      this.render();
    })
  },

  onRender() {
    if (this.state.isLoaded) {
      this.renderChart()
    }
  },

  renderChart() {
    const data = {
      title: 'Offline Volume Score (Monthly)',
      subtitle: [
        fromUnix(this.state.metadata.startDate),
        fromUnix(this.state.metadata.endDate),
      ].join(' - '),
      datasets: this.collection.map((model) => {
        const metric = model.get('metrics').pop();
        return {
          label: model.get('brand').name,
          data: [
            {
              from: metric.startDate,
              to: metric.endDate,
              value: metric.value
            }
          ]
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

export { MonthlyChart };
