/* 
 * Crated by : Faisal Khalid
 * Email     : faisal.khalid.si@gmail.com
 * Thank you..
 */

$.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = parseInt($('#start-date').val(), 10);
            var max = parseInt($('#end-date').val(), 10);
            var date_insert = parseFloat(data[0]) || 0; // use data for the age column

            if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && date_insert <= max) ||
                    (min <= date_insert && isNaN(max)) ||
                    (min <= date_insert && date_insert <= max))
            {
                return true;
            }
            return false;
        }
);
$(document).ready(function () {
    var dataTableBj = $('#gis-grid').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "bSortable": true, "bSearchable": true,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
        "ajax": {
            url: "http://localhost/besta/index.php/chart/list_data", // json datasource
            type: "post", // method  , by default get,
            "data": function (data) {
                data.start_date = $('#start-date').val();
                data.end_date = $('#end-date').val();
            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }]
    });


    var dataTable = $('#design-admin-grid').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "bSortable": true, "bSearchable": true,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
        "ajax": {
            url: "http://localhost/besta/index.php/chart/list_data_admin", // json datasource
            type: "post", // method  , by default get,
            "data": function (data) {
                data.start_date = $('#start-date').val();
                data.end_date = $('#end-date').val();
            }
        },
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }]
    });


    var startDate = Date.create().addDays(-6), // 7 days ago
            endDate = Date.create().addDays(-1); // today
    var rangeGIS = $('#secondRange');
    // Show the dates in the range input
    rangeGIS.val(startDate.format('{yyyy}-{MM}-{dd}') + ' - '
            + endDate.format('{yyyy}-{MM}-{dd}'));
    rangeGIS.daterangepicker({
        startDate: startDate,
        endDate: endDate,
        ranges: {
            'Yesterday': [Date.create().addDays(-1), 'yesterday'],
            'Last 7 Days': [Date.create().addDays(-7), 'yesterday'],
            'Last 30 Days': [Date.create().addDays(-30), 'yesterday']
        }
    }, function (start, end) {
        $('#start-date').val(start.format('{yyyy}-{MM}-{dd}'));
        $('#end-date').val(end.format('{yyyy}-{MM}-{dd}'));
//        dataTableBj.columns(0).draw();
        dataTableBj.ajax.reload();
        dataTable.ajax.reload();
//        table.draw();
    });
});