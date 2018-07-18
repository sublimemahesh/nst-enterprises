$(document).ready(function () {

    var jobcostingcard = $('.jobcostingcard').val();

    $.ajax({
        type: 'POST',
        url: 'ajax/job-costing-card-report.php',
        dataType: "json",
        data: {jobcostingcard: jobcostingcard, option: 'GETVALUE'},
        success: function (result) {
            if (result.length === 0) {
                
            } else {
                $.each(result, function (key) {
                    $('.vno-' + this.reimbursementItem).val(this.voucherNumber);
                    $('.amount-' + this.reimbursementItem).val(this.amount);
                    $('.description-' + this.reimbursementItem).val(this.description);
                    $('.id-' + this.reimbursementItem).val(this.id);
                });


            }
        }
    });

});


