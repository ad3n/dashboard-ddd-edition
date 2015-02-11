Chart.buildIndikatorList = function (indikators, limit, start) {
    var html = '';
    var length = indikators.length;

    if (0 > start) {
        start = 0;
    }

    for (var i = start; i < (limit + start); i++) {
        if (length > i) {
            html = html + '<button type="button" data="' + indikators[i].code + '" class="indikatorList btn btn-primary btn-lg btn-block">' + indikators[i].name + '</button>';
        }
    }

    var paging = '';
    if (0 === start) {
        paging = paging + '<button type="button" class="btn btn-lg btn-primary pull-left sebelum" disabled="disabled">Sebelumnya</button>';
    } else {
        paging = paging + '<button type="button" class="btn btn-lg btn-primary pull-left sebelum">Sebelumnya</button>';
    }

    if (length < (limit + start)) {
        paging = paging + '<button type="button" class="btn btn-lg btn-primary pull-right setelah" disabled="disabled">Selanjutnya</button>';
    } else {
        paging = paging + '<button type="button" class="btn btn-lg btn-primary pull-right setelah">Selanjutnya</button>';
    }

    jQuery('#block14').html(html);
    jQuery('#paging').html(paging);
    Chart.indikatorListClickHandler(indikators);
};

Chart.indikatorListClickHandler = function (indikators) {
    jQuery('.indikatorList').on('click', function () {
        var indikator = jQuery(this).attr('data');
        Chart.createMainChart(indikator, Chart.page);
    });

    jQuery('.sebelum').on('click', function () {
        Chart.page = Chart.page - Chart.perPage;

        Chart.buildIndikatorList(indikators, Chart.perPage, Chart.page);
    });

    jQuery('.setelah').on('click', function () {
        Chart.page = Chart.page + Chart.perPage;

        Chart.buildIndikatorList(indikators, Chart.perPage, Chart.page);
    });
};