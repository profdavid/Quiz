'use strict';
$(document).ready(function() {
    setTimeout(function() {
        // [ line-chart ] start
        nv.addGraph(function() {
            var chart = nv.models.lineChart()
                .showLegend(true);
            chart.xAxis
                .axisLabel('Time (ms)')
                .tickFormat(d3.format(',r'));

            chart.yAxis
                .axisLabel('Voltage (v)')
                .tickFormat(d3.format('.02f'));

            var myData = sinAndCos(); //You need data...

            d3.select('#nvd3-line-1 svg') //Select the <svg> element you want to render the chart in.
                .datum(myData) //Populate the <svg> element with chart data...
                .call(chart);

            //Update the chart when window resizes.
            nv.utils.windowResize(function() {
                chart.update()
            });
            return chart;
        });

        function sinAndCos() {
            var sin = [],
                sin2 = [],
                cos = [];
            for (var i = 0; i < 100; i++) {
                sin.push({
                    x: i,
                    y: Math.sin(i / 10)
                });
                sin2.push({
                    x: i,
                    y: Math.sin(i / 10) * 0.25 + 0.5
                });
                cos.push({
                    x: i,
                    y: .5 * Math.cos(i / 10)
                });
            }
            return [{
                    values: sin,
                    key: 'Sine Wave',
                    color: '#7759de'
                },
                {
                    values: cos,
                    key: 'Cosine Wave',
                    color: '#f44336'
                },
                {
                    values: sin2,
                    key: 'Another sine wave',
                    color: '#2196f3',
                    area: true
                }
            ];
        }
        // [ line-chart ] end

        // [ Discrete-Bar-Chart ] start
        nv.addGraph(function() {
            var chart = nv.models.discreteBarChart()
                .x(function(d) {
                    return d.label
                })
                .y(function(d) {
                    return d.value
                })
                .staggerLabels(true) //Too many bars and not enough room? Try staggering labels.
                .showValues(true) //...instead, show the bar value right on top of each bar.
            d3.select('#nvd3-bar-1').append('svg')
                .datum(barData())
                .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
        //Each bar represents a single discrete quantity.
        function barData() {
            return [{
                key: "Cumulative Return",
                values: [{
                    "label": "A",
                    "value": -29.765957771107,
                    "color": "#3ebfea"
                }, {
                    "label": "B",
                    "value": 10,
                    "color": "#f44336"
                }, {
                    "label": "C",
                    "value": 32.807804682612,
                    "color": "#FF9800"
                }, {
                    "label": "D",
                    "value": 196.45946739256,
                    "color": "#2196f3"
                }, {
                    "label": "E",
                    "value": 0.25434030906893,
                    "color": "#f44336"
                }, {
                    "label": "F",
                    "value": -98.079782601442,
                    "color": "#7759de"
                }, {
                    "label": "G",
                    "value": -13.925743130903,
                    "color": "#4caf50"
                }, {
                    "label": "H",
                    "value": -5.1387322875705,
                    "color": "#00ACC1"
                }]
            }]
        }
        // [ Discrete-Bar-Chart ] end

        // [ Stacked-Bar-Chart ] start
        nv.addGraph(function() {
            var chart = nv.models.multiBarChart()
                .reduceXTicks(true)
                .rotateLabels(0)
                .showControls(true)
                .groupSpacing(0.1)
                .color(['#2196f3', '#7759de', '#4caf50']);

            chart.xAxis
                .tickFormat(d3.format(',f'));

            chart.yAxis
                .tickFormat(d3.format(',.1f'));

            d3.select('#nvd3-multi-bar-1').append('svg')
                .datum(stackedData())
                .call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
        //Generate some nice data.
        function stackedData() {
            return stream_layers(3, 10 + Math.random() * 100, .1).map(function(data, i) {
                return {
                    key: 'Stream #' + i,
                    values: data
                };
            });
        }
        // [ Stacked-Bar-Chart ] end

        // [ pie-Chart ] start
        nv.addGraph(function() {
            var chart = nv.models.pieChart()
                .x(function(d) {
                    return d.label
                })
                .y(function(d) {
                    return d.value
                })
                .showLabels(true);

            d3.select("#nvd3-pie-1").append('svg')
                .datum(pieData())
                .datum(pieData())
                .transition().duration(350)
                .call(chart);
            nv.utils.windowResize(chart.update);

            return chart;
        });

        function pieData() {
            return [{
                "label": "One",
                "value": 29.765957771107,
                "color": "#FF9800"
            }, {
                "label": "Two",
                "value": 0,
                "color": "#f44336"
            }, {
                "label": "Three",
                "value": 32.807804682612,
                "color": "#7759de"
            }, {
                "label": "Four",
                "value": 196.45946739256,
                "color": "#2196f3"
            }, {
                "label": "Five",
                "value": 0.19434030906893,
                "color": "#00ACC1"
            }, {
                "label": "Six",
                "value": 98.079782601442,
                "color": "#4caf50"
            }, {
                "label": "Seven",
                "value": 13.925743130903,
                "color": "#ff8a65"
            }, {
                "label": "Eight",
                "value": 5.1387322875705,
                "color": "#f44336"
            }];
        }
        // [ pie-Chart ] end

        // [ Donut-Chart ] start
        nv.addGraph(function() {
            var chart = nv.models.pieChart()
                .x(function(d) {
                    return d.label
                })
                .y(function(d) {
                    return d.value
                })
                .showLabels(true)
                .labelThreshold(.05)
                .labelType("percent")
                .donut(true)
                .donutRatio(0.35);
            d3.select("#nvd3-donut-1").append('svg')
                .datum(donutData())
                .transition().duration(350)
                .call(chart);
            nv.utils.windowResize(chart.update);
            return chart;
        });

        function donutData() {
            return [{
                "label": "One",
                "value": 29.765957771107,
                "color": "#FF9800"
            }, {
                "label": "Two",
                "value": 0,
                "color": "#f44336"
            }, {
                "label": "Three",
                "value": 32.807804682612,
                "color": "#7759de"
            }, {
                "label": "Four",
                "value": 196.45946739256,
                "color": "#2196f3"
            },  {
                "label": "Five",
                "value": 0.19434030906893,
                "color": "#00ACC1"
            }, {
                "label": "Six",
                "value": 98.079782601442,
                "color": "#4caf50"
            }, {
                "label": "Seven",
                "value": 13.925743130903,
                "color": "#ff8a65"
            }, {
                "label": "Eight",
                "value": 5.1387322875705,
                "color": "#f44336"
            }];
        }
        // [ Donut-Chart ] end
    }, 700);
});
