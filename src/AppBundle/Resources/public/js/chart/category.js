Chart.category = function (data, total, selector, title, xAxis, type, handler) {
    var option = {
        chart : {
            type: type
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: xAxis
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y} %</b>'
        },
        plotOptions: {
            series: {
                point: {
                    events: handler
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        series: data
    };

    console.log(data, xAxis);

    jQuery(selector + ' .chart-title').html(title);
    jQuery(selector + ' .chart-stage').highcharts(option);
    jQuery(selector + ' .chart-notes').html('Total: ' + total);
};