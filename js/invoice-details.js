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
                $('#created_at').val(new Date().toISOString().slice(0, 10));
            } else {
                $('#id').val(result.id);
                $('#vat_reg_no').val(result.vat_reg_no);
                $('#datepicker1').val(result.cleared_date);
                $('#gross_weight').val(result.gross_weight);
                $('#volume').val(result.volume);
                $('#cusdec_no').val(result.cusdec_no);
                $('#agency_fees').val(result.agency_fees);
                $('#documentation').val(result.documentation);
                $('#vat').val(result.vat);
                $('#vat').attr("vat", result.vat);
                $('#tax-invoice-total').html(result.tax_total);
                $('#tax-invoice-total').attr("total", result.tax_total);
                $('#created_at').val(result.createdAt);
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

});


