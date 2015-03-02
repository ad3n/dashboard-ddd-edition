var Chart = {};

Chart.scope = '';
Chart.perPage = 8;
Chart.page = 0;
Chart.indikator = [];
Chart.wilayah = [];
Chart.regional = [];

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

Chart.getDetailChart = function (indikator, bulan, kode, data) {
    var now = new Date();
    var dari = '0';
    var sampai = '0';
    bulan = jQuery.inArray(bulan, Chart.BulanIndonesia);
    bulan++;

    var dariBulan = '' === jQuery("#dari-bulan").val() ? bulan: jQuery("#dari-bulan").val();
    if (dariBulan) {
        var dariTahun = '' === jQuery("#dari-tahun").val() ? now.getFullYear(): jQuery("#dari-tahun").val();
        dari = dariBulan + '_' + dariTahun;
    }

    var sampaiBulan = '' === jQuery("#sampai-bulan").val() ? bulan: jQuery("#sampai-bulan").val();
    if (sampaiBulan) {
        var sampaiTahun = '' === jQuery("#sampai-tahun").val() ? now.getFullYear(): jQuery("#sampai-tahun").val();
        sampai = sampaiBulan + '_' + sampaiTahun;
    }

    Chart.getDetail(indikator, data['scope'], bulan, dari, sampai);
};

Chart.init = function () {
    var bulan = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
    var now = new Date();

    for (var i = 2014; i <= now.getFullYear(); i++) {
        jQuery('#dari-tahun').append(jQuery("<option></option>").attr("value", i).text(i));
        jQuery('#sampai-tahun').append(jQuery("<option></option>").attr("value", i).text(i));
    }

    for (var i = 0; i <= bulan.length - 1; i++) {
        jQuery('#dari-bulan').append(jQuery("<option></option>").attr("value", i + 1 ).text(bulan[i]));
        jQuery('#sampai-bulan').append(jQuery("<option></option>").attr("value", i + 1 ).text(bulan[i]));
    }

    jQuery('#wilayah').autocomplete({
        source: function (request, response) {
            if (request.term.length >= 3) {
                Chart.request(function (result) {
                    Chart.wilayah = result;
                    response(result);
                }, '/api/wilayah/get_like/' + request.term);
            }
        },
        select: function (event, ui) {
            jQuery('#wilayah-value').val(ui.item.value);
        }
    });

    jQuery('#regional').autocomplete({
        source: function (request, response) {
            if (request.term.length >= 3) {
                Chart.request(function (result) {
                    Chart.regional = result;
                    response(result);
                }, '/api/regional/get_like/' + request.term);
            }
        },
        select: function (event, ui) {
            jQuery('#regional-value').val(ui.item.value);
        }
    });

    jQuery('.filter').on('click', Chart.doFilter);
};

Chart.doFilter = function () {
    var sekarang = new Date();

    var wilayah = jQuery('#wilayah-value').val();
    var regional = jQuery('#regional-value').val();

    var dariBulan = jQuery('#dari-bulan').val();
    var dariTahun = jQuery('#dari-tahun').val();

    var sampaiBulan = jQuery('#sampai-bulan').val();
    var sampaiTahun = jQuery('#sampai-tahun').val();

    if ('' !== wilayah) {
        regional = '';
    }

    if ('' !== regional) {
        wilayah = '';
    }

    if ('' === dariBulan) {
        dariBulan = 1;
    }

    if ('' === dariTahun) {
        dariTahun = sekarang.getFullYear();
    }

    if ('' === sampaiBulan) {
        sampaiBulan = sekarang.getMonth();
    }

    if ('' === sampaiTahun) {
        sampaiTahun = sekarang.getFullYear();
    }

    Chart.render(wilayah, regional, dariBulan, dariTahun, sampaiBulan, sampaiTahun);
};

Chart.render = function (wilayah, regional, dariBulan, dariTahun, sampaiBulan, sampaiTahun) {

};