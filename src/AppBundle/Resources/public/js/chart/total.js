Chart.renderTotal = function (selector, data) {
    var total = 0;
    jQuery.each(data['data'], function (key, value) {
        jQuery.each(value, function (k, v) {
            total += parseInt(v.nominator);
        });
    });

    jQuery(selector + ' .chart-title').html(data.indikator.title);
    var _ = jQuery(selector + ' .chart-notes');
    _.html(Chart.formatNumber(total, '.'));
    _.css('font-weight', 'bold');
    _.css('text-align', 'center');
    _.css('font-size', 21);
};
