$(document).ready(function () {
    $("#btn-invoice").click(function () {

        var jobcostingcard = $("#job_costing_card").val();
        var createdAt = $("#createdAt").text();
        var vat_reg_no = $("#vat_reg_no").val();
        var cleared_date = $("#datepicker1").val();
        var gross_weight = $("#gross_weight").val();
        var volume = $("#volume").val();
        var cusdec_no = $("#cusdec_no").val();
        var agency_fees = $("#agency_fees").val();
        var documentation = $("#documentation").val();
        var vat = $("#vat").attr('vat');
        var payable_amount = $("#payable-amount").attr('amount');
        var advance = $("#advance").attr('advance');
        var due = $("#due").attr('due');


        $.ajax({
            type: 'POST',
            url: 'ajax/invoice.php',
            dataType: "json",
            data: {
                job_costing_card: jobcostingcard,
                createdAt: createdAt,
                vat_reg_no: vat_reg_no,
                cleared_date: cleared_date,
                gross_weight: gross_weight,
                volume: volume,
                cusdec_no: cusdec_no,
                agency_fees: agency_fees,
                documentation: documentation,
                vat: vat,
                payable_amount: payable_amount,
                advance: advance,
                due: due,
                option: 'ADDINVOICE'
            },
            success: function (result) {

                swal({
                    title: "Success!",
                    text: "Your data was saved successfully.",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });


            }
        });

    });
});


