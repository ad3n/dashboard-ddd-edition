var Chart = {};

Chart.scope = '';
Chart.perPage = 8;
Chart.page = 0;
Chart.indikator = [];

Chart.BulanIndonesia = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

Chart.createGauge = function (data, selector, title, handler) {
    Chart.scope = data['scope'];
    var now = new Date();
    var subtitle = '';
    var output = 0;
    var total = 0;
    var i = 0;

    jQuery.each(data['data'], function (key, value) {
        if ('' === subtitle) {
            subtitle = ' TAHUN ' + key;
        }

        jQuery.each(value, function (k, v) {
            if ('undefined' !== typeof v['value']) {
                output = output + parseInt(v['value']);
                total = total + parseInt(v['nominator']);
            }

            i++;
        });
    });

    i = 0 === i ? 1 : i;

    if ('' === subtitle) {
        subtitle = ' TAHUN ' + now.getFullYear();
    }

    Chart.gauge({
        name: 'Rata-rata',
        data: [parseInt(output / i)],
        tooltip: {
            valueSuffix: ' %'
        }
    }, total, selector, title + subtitle, data['indikator']['merah'], data['indikator']['kuning'], data['indikator']['hijau'], 100, handler);
};

Chart.createPie = function (data, seletor, title, handler) {
    var temp = Chart.processDataPerBulan(data);
    var output = [];
    var total = 0;

    jQuery.each(temp[0]['nominal'], function (key, value) {
        output.push([Chart.BulanIndonesia[key], value]);
        total = total + value;
    });

    Chart.pie({
        type: 'pie',
        name: 'Total',
        data: output
    }, temp['total'], seletor, title + ' TAHUN ' + temp[0]['name'], handler);
};

Chart.createBar = function (handler, data, selector, title) {
    var output = Chart.processDataPerBulan(data);

    Chart.category(output, output['total'], selector, title, Chart.BulanIndonesia, 'bar', handler);
};

Chart.createColumn = function (handler, data, selector, title) {
    var output = Chart.processDataPerBulan(data);

    Chart.category(output, output['total'], selector, title, Chart.BulanIndonesia, 'column', handler);
};

Chart.createLine = function (handler, data, selector, title) {
    var output = Chart.processDataPerBulan(data);

    Chart.category(output, output['total'], selector, title, Chart.BulanIndonesia, 'line', handler);
};

Chart.createArea = function (handler, data, selector, title) {
    var output = Chart.processDataPerBulan(data);

    Chart.category(output, output['total'], selector, title, Chart.BulanIndonesia, 'area', handler);
};

Chart.createMainChart = function (indikator) {
    Chart.get(function (data) {
        Chart.createColumn({
            click: function (e) {
                Chart.getDetailChart(indikator, this.category, this.series.name, data);
            }
        }, data, '#main-block', data['indikator']['name']);

        Chart.createIndicatorListChart(indikator);
    }, indikator, 'nasional');
};

Chart.createIndicatorListChart = function (indikator) {
    Chart.getIndikator(function (data) {
        var chart = Chart.processDataGlobal(data);

        Chart.category([chart['data']], chart['data']['total'], '#indicator-block', '', chart['indikator'], 'bar', {
            click: function (e) {
                var category = this.category;
                Chart.get(function (data) {
                    Chart.createColumn({
                        click: function (e) {
                            Chart.getDetailChart(category, this.category, this.series.name, data);
                        }
                    }, data, '#main-block', data['indikator']['name']);
                }, category, 'nasional');
            }
        });

    }, indikator, 'nasional');
};

Chart.getDetailChart = function (indikator, bulan, tahun, data) {
    var now = new Date();
    var dari = '0';
    var sampai = '0';

    var dariBulan = '' === jQuery("#dari-bulan").val() ? null: jQuery("#dari-bulan").val();
    if (dariBulan) {
        var dariTahun = '' === jQuery("#dari-tahun").val() ? now.getFullYear(): jQuery("#dari-tahun").val();
        dari = dariBulan + '_' + dariTahun;
    }

    var sampaiBulan = '' === jQuery("#sampai-bulan").val() ? null: jQuery("#sampai-bulan").val();
    if (sampaiBulan) {
        var sampaiTahun = '' === jQuery("#sampai-tahun").val() ? now.getFullYear(): jQuery("#sampai-tahun").val();
        sampai = sampaiBulan + '_' + sampaiTahun;
    }

    var key = jQuery.inArray(bulan, Chart.BulanIndonesia);

    Chart.getDetail(indikator, data['scope'], data['indikator']['code'], dari, sampai);
};