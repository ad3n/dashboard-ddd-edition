Chart.gauge = function (data, total, selector, title, startIndicator, yellowIndicator, greenIndicator, endIndicator, handler) {
    startIndicator = parseInt(startIndicator);
    yellowIndicator = parseInt(yellowIndicator);
    greenIndicator = parseInt(greenIndicator);
    endIndicator = parseInt(endIndicator);

    var option = {
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false,
            events: handler,
            height: 150
        },
        title: {
            text: ''
        },
        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },
        yAxis: {
            min: startIndicator,
            max: endIndicator,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: ''
            },
            plotBands: [{
                from: startIndicator,
                to: yellowIndicator,
                color: '#DF5353'
            }, {
                from: yellowIndicator,
                to: greenIndicator,
                color: '#DDDF0D'
            }, {
                from: greenIndicator,
                to: endIndicator,
                color: '#55BF3B'
            }]
        },
        series: [data]
    };

    jQuery(selector + ' .chart-title').html(title);
    jQuery(selector + ' .chart-stage').highcharts(option);
    jQuery(selector + ' .chart-notes').html('Total: ' + Chart.formatNumber(total, '.'));
};