$(document).ready(function () {


});
$(function () {
// Set the default dates
    var startDate = Date.create().addDays(-6), // 7 days ago
            endDate = Date.create().addDays(-1); // today
    var range = $('#range');
    // Show the dates in the range input
    range.val(startDate.format('{yyyy}-{MM}-{dd}') + ' - '
            + endDate.format('{yyyy}-{MM}-{dd}'));

    ajaxLoadChart(startDate, endDate);
    range.daterangepicker({
        startDate: startDate,
        endDate: endDate,
        ranges: {
//            'Today': ['today', 'today'],
            'Yesterday': [Date.create().addDays(-2), 'yesterday'],
            'Last 7 Days': [Date.create().addDays(-6), 'yesterday'],
            'Last 30 Days': [Date.create().addDays(-29), 'yesterday']
        }
    }, function (start, end) {
        ajaxLoadChart(start, end);
    });




//    $('#tableDua').dataTable({
//        "bPaginate": false,
//        "bFilter": false,
//        "bInfo": false
//    });

// Function for loading data via AJAX and showing it on the chart
    function ajaxLoadChart(startDate, endDate) {
// If no data is passed (the chart was cleared)
        if (!startDate || !endDate) {
            return;
        }
// Otherwise, issue an AJAX request
        $.post('http://localhost/besta/index.php/highchart/get_chart_data_tiga', {
            start: startDate.format('{yyyy}-{MM}-{dd}'),
            end: endDate.format('{yyyy}-{MM}-{dd}')
        }, function (data) {

            usedrwoJson = data['usedrwoJson'];
            usedrwoJson = jQuery.parseJSON(usedrwoJson);
            usedgdbJson = data['usedgdbJson'];
            usedgdbJson = jQuery.parseJSON(usedgdbJson);
            regdgdbJson = data['regdgdbJson'];
            regdgdbJson = jQuery.parseJSON(regdgdbJson);
            regswoJson = data['regswoJson'];
            regswoJson = jQuery.parseJSON(regswoJson);
//            alert(usedrwoJson);
//            ----------------------
            if ((usedrwoJson.indexOf("No record found") > -1)
                    || (usedrwoJson.indexOf("Date must be selected.") > -1)) {
                $('#msg').html('<span style="color:red;">' + usedrwoJson + '</span>');
                alert("Asd");
            } else {
                $('#msg').empty();
                $('#thirdChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ''
//                        text: 'Monitoring Alternatives Pada Aplikasi Small World PNI / IBRITE Pasca Kompresi File'
                    },
//                    subtitle: {
//                        text: 'Source: WorldClimate.com'
//                    },
                    xAxis: {
                        type: 'category',
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'rwo.ds',
                            color: 'orange',
                            data: usedrwoJson
                        },
                        {
                            name: 'dgb.ds',
                            color: 'green',
                            data: usedgdbJson
                        }
                    ]
                });
                $('#thirdChartDua').highcharts({
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ''
//                        text: 'Monitoring Alternatives Pada Aplikasi Small World PNI / IBRITE Pasca Kompresi File'
                    },
//                    subtitle: {
//                        text: 'Source: WorldClimate.com'
//                    },
                    xAxis: {
                        type: 'category',
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'reguler rwo',
                            color: 'gray',
                            data: regswoJson
                        },
                        {
                            name: 'reguler dgb',
                            color: 'blue',
                            data: regdgdbJson
                        }]
                });
            }
        }, 'json');
    }

//    var secondRange = $('#secondRange');
//    // Show the dates in the range input
//    secondRange.val(startDate.format('{yyyy}-{MM}-{dd}') + ' - '
//            + endDate.format('{yyyy}-{MM}-{dd}'));
//
//    ajaxLoadBigChart(startDate, endDate);
//    secondRange.daterangepicker({
//        startDate: startDate,
//        endDate: endDate,
//        ranges: {
////            'Today': ['today', 'today'],
//            'Yesterday': [Date.create().addDays(-2), 'yesterday'],
//            'Last 7 Days': [Date.create().addDays(-6), 'yesterday'],
//            'Last 30 Days': [Date.create().addDays(-29), 'yesterday']
//        }
//    }, function (start, end) {
//        ajaxLoadBigChart(start, end);
//    });

    function ajaxLoadBigChart(startDate, endDate) {
// If no data is passed (the chart was cleared)
        if (!startDate || !endDate) {
            return;
        }
// Otherwise, issue an AJAX request
        $.post('http://localhost/besta/index.php/highchart/get_chart_data_tiga', {
            start: startDate.format('{yyyy}-{MM}-{dd}'),
            end: endDate.format('{yyyy}-{MM}-{dd}')
        }, function (data) {

            usedrwoJson = data['usedrwoJson'];
            usedrwoJson = jQuery.parseJSON(usedrwoJson);
            usedgdbJson = data['usedgdbJson'];
            usedgdbJson = jQuery.parseJSON(usedgdbJson);
            regdgdbJson = data['regdgdbJson'];
            regdgdbJson = jQuery.parseJSON(regdgdbJson);
            regswoJson = data['regswoJson'];
            regswoJson = jQuery.parseJSON(regswoJson);
//            alert(usedrwoJson);
//            ----------------------
            if ((usedrwoJson.indexOf("No record found") > -1)
                    || (usedrwoJson.indexOf("Date must be selected.") > -1)) {
                $('#msg').html('<span style="color:red;">' + usedrwoJson + '</span>');
                alert("Asd");
            } else {
                $('#msg').empty();
                $('#thirdChart').highcharts({
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ''
//                        text: 'Monitoring Alternatives Pada Aplikasi Small World PNI / IBRITE Pasca Kompresi File'
                    },
//                    subtitle: {
//                        text: 'Source: WorldClimate.com'
//                    },
                    xAxis: {
                        type: 'category',
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'rwo.ds',
                            color: 'orange',
                            data: usedrwoJson
                        },
                        {
                            name: 'dgb.ds',
                            color: 'green',
                            data: usedgdbJson
                        }
                    ]
                });
                $('#thirdChartDua').highcharts({
                    chart: {
                        type: 'column'
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: ''
//                        text: 'Monitoring Alternatives Pada Aplikasi Small World PNI / IBRITE Pasca Kompresi File'
                    },
//                    subtitle: {
//                        text: 'Source: WorldClimate.com'
//                    },
                    xAxis: {
                        type: 'category',
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Jumlah'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                            name: 'reguler rwo',
                            color: 'gray',
                            data: regswoJson
                        },
                        {
                            name: 'reguler dgb',
                            color: 'blue',
                            data: regdgdbJson
                        }]
                });
            }
        }, 'json');
    }
});
