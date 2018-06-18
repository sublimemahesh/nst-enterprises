$(document).ready(function () {
    $("#submitbutton").click(function () {
        var data = [];
        var jobcostingcard, rid, vno, amount, description;

        jobcostingcard = $(".jobcostingcard").val();

        $("table tbody tr").each(function (index) {
            rid = $(this).find('.rid').attr("rid");
            vno = $(this).find('.vno').val();
            amount = $(this).find('.amount').val();
            description = $(this).find('.description').val();


            data.push({
                jobcostingcard:jobcostingcard,
                rid: rid,
                vno: vno,
                amount: amount,
                description: description
            });
        });

        submitFormData(data);

    });
    function submitFormData(formData) {

        $.ajax({
            type: 'POST',
            data: {data: formData},
            cache: false,
            url: 'ajax/create-job-costing-card.php',
            success: function (result) {
                if (result == true) {
                    window.location.replace("create-job-costing-card.php?message=10");
                } else {
                    return false;
                }
            }
        });
    }
});