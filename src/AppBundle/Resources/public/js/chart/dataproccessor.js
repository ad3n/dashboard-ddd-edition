Chart.processDataPerTahun = function (data) {
    var output = [];
    output['tahun'] = [];
    output['data'] = [];
    output['data']['name'] = 'Total';
    output['data']['data'] = [];

    jQuery.each(data['data'], function (key, value) {
        output['tahun'].push(key);
        var data = 0;

        jQuery.each(value, function (k, v) {
            data = data + parseInt(v['value']);
        });

        output['data']['data'].push(data);
    });

    return output;
};

Chart.processDataPerBulan = function (data, type) {
    Chart.scope = data['scope'];
    var output = [];
    output['total'] = 0;
    var i = 0;

    jQuery.each(data['data'], function (key, value) {
        var data = [];
        output[i] = [];

        output[i]['name'] = key;
        output[i]['type'] = type;

        jQuery.each(value, function (k, v) {
            if ('undefined' !== typeof v['value']) {
                data.push(parseInt(v['value']));
                output['total'] = output['total'] + parseInt(v['nominator']);
            } else {
                data.push(0);
            }
        });

        output[i]['data'] = data;

        i++;
    });

    return output;
};

Chart.processDataGlobal = function (data) {
    var output = [];
    output['indikator'] = [];
    output['data'] = [];
    output['data']['name'] = 'Data';
    output['data']['data'] = [];
    var total = 0;

    jQuery.each(data['indikator']['child'], function (key, value) {
        output['indikator'].push(value.code);
    });

    jQuery.each(data['data'], function (key, value) {
        var data = 0;
        jQuery.each(value, function (k, v) {
            total = Object.keys(v).length;
            jQuery.each(v, function (y, z) {
                if ('undefined' !== typeof z['value']) {
                    data = data + parseInt(z['value']);
                }
            });
        });

        output['data']['data'].push(Math.round(data / total));
    });

    return output;
};