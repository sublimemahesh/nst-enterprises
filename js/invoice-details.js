$(document).ready(function () {

    var jobcostingcard = $('#job_costing_card').val();

    $.ajax({
        type: 'POST',
        url: 'ajax/invoice.php',
        dataType: 'json',
        data: {jobcostingcard: jobcostingcard, option: 'GETVALUE'},
        success: function (result) {
            if (result === false) {
                $('#savebutton').removeClass('hidden');
                $('#savebutton-print').removeClass('hidden');
                $('.inv-title').text('Create ');
                $('#tax-value').text('0');
                $('#tax-value').attr('tax', '0');
                var date = new Date().toISOString().slice(0, 10);
                var formatted_date = GetFormattedDate(date);
                $('#created_at').val(formatted_date);
                $('#created_at').attr('date', date);
            } else {
                $('#id').val(result.id);
                $('#vat_reg_no').val(result.vat_reg_no);
                var formatted_date1 = GetFormattedDate(result.cleared_date);
                $('#datepicker1').val(formatted_date1);
                $('#datepicker1').attr('date', result.cleared_date);

//                $('#datepicker1').val(result.cleared_date);
                $('#gross_weight').val(result.gross_weight);
                $('#volume').val(result.volume);
                $('#cusdec_no').val(result.cusdec_no);
                $('#agency_fees').val(result.agency_fees);
                $('#documentation').val(result.documentation);
                $('#vat').val(result.vat);
                $('#vat').attr("vat", result.vat);
                $('#tax-invoice-total').html(result.tax_total);
                $('#tax-invoice-total').attr("total", result.tax_total);

                var formatted_date = GetFormattedDate(result.createdAt);
                $('#created_at').val(formatted_date);
                $('#created_at').attr('date', result.createdAt);

                if (result.createdAt < '2019-12-01') {
                    $('#tax-value').text('15');
                    $('#tax-value').attr('tax', '15');
                } else if (result.createdAt < '2020-01-01') {
                    $('#tax-value').text('8');
                    $('#tax-value').attr('tax', '8');
                } else {
                    $('#tax-value').text('0');
                    $('#tax-value').attr('tax', '0');
                }

                $('#editbutton').removeClass('hidden');
                $('#editbutton-print').removeClass('hidden');
                $('.inv-title').text('Edit ');

            }
        }
    });

    $("#created_at").change(function () {
        var newdate = $("#created_at").val();
        $("#created_at").attr('date', newdate);

        var formatted_date = GetFormattedDate(newdate);
        $('#created_at').val(formatted_date);
    });
    $("#datepicker1").change(function () {
        var newdate = $("#datepicker1").val();
        $("#datepicker1").attr('date', newdate);

        var formatted_date1 = GetFormattedDate(newdate);
        $('#datepicker1').val(formatted_date1);
    });

    function GetFormattedDate(date) {
        var todayTime = new Date(date);
        var month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"][todayTime.getMonth()];
        var day = todayTime.getDate();
        if (day < 10) {
            day = '0' + day;
        } else {
            day = day;
        }
        var year = todayTime.getFullYear();
        var new_date = day + " " + month + " " + year
        return new_date;

    }


});


