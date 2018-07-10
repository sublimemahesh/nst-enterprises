$(document).ready(function () {

    var jobcostingcard = $('#job_costing_card').val();

    $.ajax({
        type: 'POST',
        url: 'ajax/invoice.php',
        dataType: "json",
        data: {jobcostingcard: jobcostingcard, option: 'GETVALUE'},
        success: function (result) {
            if (result === 0) {
                $('#savebutton').removeClass('hidden');
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
                $('#vat').attr("vat",result.vat);
                $('#tax-invoice-total').html(result.tax_total);
                $('#tax-invoice-total').attr("total", result.tax_total);
//                    $('#statutory-sub-total').val(this.statutory_sub_total);
//                    $('#delivery-sub-total').val(this.delivery_sub_total);
                $('#payable-amount').html(result.payable_amount);
                $('#payable-amount').attr("amount", result.payable_amount);
                $('#advance').val(result.advance);
                $('#advance').attr("advance", result.advance);

                $('#due').html(result.due);
                $('#due').attr("due", result.due);



                $('#editbutton').removeClass('hidden');

            }
        }
    });

});


