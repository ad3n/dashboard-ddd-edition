Chart.request = function (callback, indikator, scope, kode, tahun, bulan) {
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

    jQuery.ajax({
        url: '/api/chart/get/' + indikator + '/' + scope + '/' + kode + '/' + tahun + '/' + bulan,
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