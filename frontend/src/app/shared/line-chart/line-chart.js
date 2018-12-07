import { View } from 'backbone.marionette';
import * as d3 from 'd3';
import * as _ from 'underscore';

const LineChart = View.extend({
  className: 'c-line-chart',
  template: require('./line-chart.hbs'),
  options: {
    width: 1000,
    height: 400,
    yTickValues: [0, 25, 50, 75, 100],
    xTickValues: [],
    datasets: [],
    xDomain: null,
    yDomain: null,
  },

  initialize(options) {
    this.options = _.extend(this.options, options);
  },

  serializeData() {
    return {
      title: this.options.title
    }
  },

  onRender() {
    const margin = {top: 50, right: 50, bottom: 50, left: 50};
    const width = this.width = Math.min(this.options.width, window.innerWidth);
    const height = this.height = Math.min(this.options.height, (window.innerHeight / 2));
    const length = Math.max(
      ...this.options.datasets.map(dataset => dataset.length)
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

    this.svg = d3.select(this.el).append("svg")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
      .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    this.renderXAxis();
    this.renderYAxis();
    this.renderLines();
  },

  renderXAxis() {
    this.svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + this.height + ")")
      .call(
        d3.axisBottom(this.xScale)
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
    this.options.datasets.map((dataset, index) => {
      this.svg.append("path")
        .datum(dataset)
        .attr("class", `line line-${index}`)
        .attr("d", this.line);

      this.svg.selectAll(`.dot-${index}`)
        .data(dataset)
        .enter().append("circle")
        .attr("class", `dot dot-${index}`)
        .attr("cx", (d, i) => this.xScale(i))
        .attr("cy", d => this.yScale(d.value))
        .attr("r", 5);
    })
  }
});

export { LineChart };
