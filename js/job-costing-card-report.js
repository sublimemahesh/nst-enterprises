$(document).ready(function () {

    var jobcostingcard = $('#job-costing-card').attr('jobcostingcard');

    $.ajax({
        type: 'POST',
        url: 'ajax/job-costing-card-report.php',
        dataType: "json",
        data: {jobcostingcard: jobcostingcard, option: 'GETVALUE'},
        success: function (result) {
            
            $.each(result, function (key) {
                $('.vno-' + this.reimbursementItem).append(this.voucherNumber);
                $('.amount-' + this.reimbursementItem).append(this.amount);
                $('.description-' + this.reimbursementItem).append(this.description);
            });

        }
    });

});


