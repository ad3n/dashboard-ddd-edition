Chart.get = function (callback, indikator, scope, kode, tahun, bulan) {
    if ("undefined" === typeof scope) {
        scope = '0';
    }

    if ("undefined" === typeof kode) {
        kode = '0';
    }

    if ("undefined" === typeof tahun) {
        tahun = '0';
    }

    if ("undefined" === typeof bulan) {
        bulan = '0';
    }

    Chart.request(callback, '/api/chart/get/' + indikator + '/' + scope + '/' + kode + '/' + tahun + '/' + bulan);
};

Chart.getIndikator = function (callback, indikator, scope, kode, tahun, bulan) {
    if ("undefined" === typeof scope) {
        scope = '0';
    }

    if ("undefined" === typeof kode) {
        kode = '0';
    }

    if ("undefined" === typeof tahun) {
        tahun = '0';
    }

    if ("undefined" === typeof bulan) {
        bulan = '0';
    }

    Chart.request(callback, '/api/chart/get_by_parent/' + indikator + '/' + scope + '/' + kode + '/' + tahun + '/' + bulan);
};

Chart.request = function (callback, url) {
    jQuery.ajax({
        url: url,
        type:'GET',
        dataType: 'json',
        beforeSend: function( xhr ) {
            Chart.modalHelper.pleaseWait();
        }
    }).done (function (response) {
        if ('function' === typeof callback) {
            Chart.modalHelper.done();
            callback(response);
        }
    });
};