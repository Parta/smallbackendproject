import { View } from 'backbone.marionette';
import * as d3 from 'd3';
import * as _ from 'underscore';
import { fromUnix } from "../../utils/dateformat";

const LineChart = View.extend({
  className: 'c-line-chart',
  template: require('./line-chart.hbs'),
  options: {
    width: 1100,
    height: 400,
    yTickValues: [0, 25, 50, 75, 100],
    xTickValues: [],
    datasets: [],
    xDomain: null,
    yDomain: null,
    tooltipHtml: () => {}
  },

  initialize(options) {
    this.options = _.extend(this.options, options);
  },

  serializeData() {
    return {
      title: this.options.title,
      subtitle: this.options.subtitle,
      datasets: this.options.datasets
    }
  },

  onRender() {
    this.renderChart();
  },

  renderChart() {
    const margin = {top: 25, right: 50, bottom: 50, left: 50};
    const width = this.width = Math.min(this.options.width, window.innerWidth);
    const height = this.height = Math.min(this.options.height, (window.innerHeight / 2));
    const length = Math.max(
      ...this.options.datasets.map(dataset => dataset.data.length)
    );

    this.xScale = d3.scaleLinear()
      .domain(this.options.xDomain || [0, length - 1])
      .range([0, width]);

    this.yScale = d3.scaleLinear()
      .domain(this.options.yDomain || [0, 100])
      .range([height, 0]);

    this.line = d3.line()
      .x((d, i) => this.xScale(i))
      .y(d => this.yScale(d.value))
      .curve(d3.curveMonotoneX);

    this.svg = d3.select(this.el).append('svg')
      .attr('width', width + margin.left + margin.right)
      .attr('height', height + margin.top + margin.bottom)
      .append('g')
      .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

    this.renderXAxis();
    this.renderYAxis();
    this.renderLines();
    this.renderLegends();
  },

  renderXAxis() {
    const xLength = this.options.datasets[0].data.length;
    const tickLabels = this.options.datasets[0].data.map(item => {
      return [
        fromUnix(item.from, 'DD MMM'),
        fromUnix(item.to, 'DD MMM')
      ].join(' - ');
    });

    this.svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + this.height + ")")
      .call(
        d3.axisBottom(this.xScale)
          .ticks(xLength)
          .tickFormat((d,i)=> tickLabels[i])
      );
  },

  renderYAxis() {
    this.svg.append("g")
      .attr("class", "y axis")
      .call(
        d3.axisLeft(this.yScale)
          .tickValues(this.options.yTickValues)
      );
  },

  renderLines() {
    // Define the div for the tooltip
    const $tooltip = d3.select(this.el).append('div')
      .attr('class', 'tooltip')
      .style('opacity', 0);

    this.options.datasets.map((dataset, index) => {
      this.svg.append('path')
        .datum(dataset.data)
        .attr('class', `line line-${index}`)
        .attr('d', this.line);

      this.svg.selectAll(`.dot-${index}`)
        .data(dataset.data)
        .enter().append('circle')
        .attr('class', `dot dot-${index}`)
        .attr('cx', (d, i) => this.xScale(i))
        .attr('cy', d => this.yScale(d.value))
        .attr('r', 5)
        .on('mouseover', (d, index) => {
          const selectedValues = this.options.datasets.map(dataset => {
            return {
              dataset,
              item: dataset.data[index],
            }
          });
          $tooltip.style('opacity', 1);
          $tooltip.html(this.options.tooltipHtml(d, selectedValues) || d.value)
              .style('left', (d3.event.pageX) + 'px')
              .style('top', (d3.event.pageY - 28) + 'px');
          })
        .on('mouseout', (d) => {
          $tooltip.style('opacity', 0);
        });
    })
  },

  renderLegends() {
    this.svg.append("g").selectAll(`.line`)
      .data(this.options.datasets)
      .enter()
      .append("text")
      .attr('class',(data, index) => `line-label line-label-${index}`)
      .attr("x", (data, index) => index * 140 + 20)
      .attr("y", 0)
      .text((dataset) => dataset.label);
  }
});

export { LineChart };
