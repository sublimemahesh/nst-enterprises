$(document).ready(function () {
    $('#saveInvoiceNumber').click(function () {
        var invoiceno = $('#invoiceNumber').val();
        var jobcostingcard = $('.jobcostingcard').val();

        $.ajax({
            type: 'POST',
            data: {
                jobcostingcard: jobcostingcard,
                invoiceno: invoiceno,
                option: 'CREATEINVOICENUMBER'
            },
            cache: false,
            url: 'ajax/job-costing-card.php',
            success: function (result) {
                swal({
                    title: "Success!",
                    text: "Invoice number has been updated successfully",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});