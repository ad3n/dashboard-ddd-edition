Chart.get = function (callback, indikator, scope, kode, dari, sampai) {
    if ("undefined" === typeof scope) {
        scope = '0';
    }

    if ("undefined" === typeof kode) {
        kode = '0';
    }

    if ("undefined" === typeof dari) {
        dari = '0';
    }

    if ("undefined" === typeof sampai) {
        sampai = '0';
    }

    Chart.request(callback, '/api/chart/get/' + indikator + '/' + scope + '/' + kode + '/' + dari + '/' + sampai);
};

Chart.getIndikator = function (callback, indikator, scope, kode, dari, sampai) {
    if ("undefined" === typeof scope) {
        scope = '0';
    }

    if ("undefined" === typeof kode) {
        kode = '0';
    }

    if ("undefined" === typeof dari) {
        dari = '0';
    }

    if ("undefined" === typeof sampai) {
        sampai = '0';
    }

    Chart.request(callback, '/api/chart/get_by_parent/' + indikator + '/' + scope + '/' + kode + '/' + dari + '/' + sampai);
};

Chart.getDetail = function (indikator, scope, kode, dari, sampai) {
    Chart.request(null, '/api/chart/detail/' + indikator + '/' + scope + '/' + kode + '/' + dari + '/' + sampai);
};

Chart.request = function (callback, url) {
    jQuery.ajax({
        url: url,
        type:'GET',
        dataType: 'json'
    }).done (function (response) {
        if ('function' === typeof callback) {
            callback(response);
        }
    });
};