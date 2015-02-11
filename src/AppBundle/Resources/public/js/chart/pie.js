Chart.pie = function (data, total, selector, title, handler) {
    var option = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,
            plotShadow: false,
            height: 177
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y} %</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            },
            series: {
                point: {
                    events: handler
                }
            }
        },
        series: [data]
    };

    jQuery(selector + ' .chart-title').html(title);
    jQuery(selector + ' .chart-stage').highcharts(option);
    jQuery(selector + ' .chart-notes').html('Total: ' + total);
};