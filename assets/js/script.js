$(function () {

    // Set the default dates
    var startDate = Date.create().addDays(-6), // 7 days ago
            endDate = Date.create().addDays(-1); // today

    var range = $('#range');

    // Show the dates in the range input
    range.val(startDate.format('{yyyy}-{MM}-{dd}') + ' - '
            + endDate.format('{yyyy}-{MM}-{dd}'));

    // Load chart
    ajaxLoadChart(startDate, endDate);

    range.daterangepicker({
        startDate: startDate,
        endDate: endDate,
        ranges: {
//            'Today': ['today', 'today'],
            'Yesterday': ['yesterday', 'yesterday'],
            'Last 7 Days': [Date.create().addDays(-6), 'yesterday'],
            'Last 30 Days': [Date.create().addDays(-29), 'yesterday']
        }
    }, function (start, end) {
        ajaxLoadChart(start, end);
    });

    // Function for loading data via AJAX and showing it on the chart
    function ajaxLoadChart(startDate, endDate) {
        // If no data is passed (the chart was cleared)
        if (!startDate || !endDate) {
            return;
        }
        // Otherwise, issue an AJAX request
        $.post('http://localhost/besta/index.php/highchart/get_chart_data', {
            start: startDate.format('{yyyy}-{MM}-{dd}'),
            end: endDate.format('{yyyy}-{MM}-{dd}')
        }, function (data) {
            sembilan = data['sembilan'];
            sembilan = jQuery.parseJSON(sembilan);

            sebelas = data['sebelas'];
            sebelas = jQuery.parseJSON(sebelas);

            empatBelas = data['empatBelas'];
            empatBelas = jQuery.parseJSON(empatBelas);
//            -----------------------------------
            updated = data['updated'];
            updated = jQuery.parseJSON(updated);
//            -----------------------------------
            created = data['created'];
            created = jQuery.parseJSON(created);
//            -----------------------------------
            free = data['free'];
            free = jQuery.parseJSON(free);
//            -----------------------------------
//            ----------------------
            if ((sembilan.indexOf("No record found") > -1)
                    || (sembilan.indexOf("Date must be selected.") > -1)) {
                $('#msg').html('<span style="color:red;">' + sembilan + '</span>');
                alert("Asd");
            } else {
                $('#msg').empty();
                $('#chart').highcharts({
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
                            name: 'Jam 09:00',
                            data: sembilan
                        },
                        {
                            name: 'Jam 11:00',
                            data: sebelas
                        },
                        {
                            name: 'Jam 14:00',
                            data: empatBelas
                        }]
                });
//                ----------------------
                $('#secondChart').highcharts({
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
                            name: 'Project ID Yang Di Update',
                            color: 'orange',
                            data: updated
                        },
                        {
                            name: 'Alternative ID Yang Di Create',
                            color: 'blue',
                            data: created
                        },
                        {
                            name: 'Alternative free',
                            data: free
                        }]
                });
            }
        }, 'json');
    }
});
