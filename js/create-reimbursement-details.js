$(document).ready(function () {
    $("#savebutton").click(function () {
        var data = [];
        var jobcostingcard, rid, vno, amount, description, type;

        jobcostingcard = $(".jobcostingcard").val();

        $("table tbody tr").each(function (index) {
            rid = $(this).find('.rid').attr("rid");
            vno = $(this).find('.vno').val();
            amount = $(this).find('.amount').val();
            description = $(this).find('.description').val();
            type = $(this).find('.rid').attr("type");


            data.push({
                jobcostingcard:jobcostingcard,
                rid: rid,
                vno: vno,
                amount: amount,
                description: description,
                type: type
            });
        });

        submitFormData(data);

    });
    function submitFormData(formData) {

        $.ajax({
            type: 'POST',
            data: {data: formData},
            cache: false,
            url: 'ajax/create-reimbursement-details.php',
            success: function (result) {
                if (result == true) {
                    window.location.replace("manage-job-costing-cards.php?message=10");
                } else {
                    return false;
                }
            }
        });
    }
});