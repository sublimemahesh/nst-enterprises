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

//                    $('#statutory-sub-total').val(this.statutory_sub_total);
//                    $('#delivery-sub-total').val(this.delivery_sub_total);
//                $('#payable-amount').html(result.payable_amount);
//                $('#payable-amount').attr("amount", result.payable_amount);
//                $('#advance').val(result.advance);
//                $('#advance').attr("advance", result.advance);



//                if (result.due != 0) {
//
//                    $('#tr-refund').addClass("hidden");
//                    $('#refund').attr("refund", 0);
//                    $('#refund').html(0);
//                    $('#tr-due').removeClass("hidden");
//
//                    $('#due').html(result.due);
//                    $('#due').attr("due", result.due);
//
//                } else {
//
//                    $('#tr-due').addClass("hidden");
//                    $('#due').attr("due", 0);
//                    $('#due').html(0);
//                    $('#tr-refund').removeClass("hidden");
//
//                    $('#refund').attr("refund", result.refund);
//                    $('#refund').html(result.refund);
//                }

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


