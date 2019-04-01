$(document).ready(function () {
    document.getElementById("editbutton").disabled = false;
    $("#editbutton").click(function () {
        document.getElementById("editbutton").disabled = true;
        callLoader();
        var data = [];
        var id, jobcostingcard, rid, vno, amount, description, type;

        jobcostingcard = $(".jobcostingcard").val();

        $("table tbody tr").each(function (index) {
            id = $(this).find('.id').val();
            rid = $(this).find('.rid').attr("rid");
            vno = $(this).find('.vno').val();
            amount = $(this).find('.amount').val();
            description = $(this).find('.description').val();
            type = $(this).find('.rid').attr("type");
            


            data.push({
                id: id,
                jobcostingcard: jobcostingcard,
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
            url: 'ajax/edit-reimbursement-details.php',
            success: function (result) {
                if (result == true) {
                    window.location.replace("manage-job-costing-cards.php?message=10");
                } else {
                    return false;
                }
            }
        });
    }
    
    function callLoader() {
        $.loadingBlockShow({
            imgPath: 'plugins/loader/img/default.svg',
            style: {
                position: 'fixed',
                width: '100%',
                height: '100%',
                background: 'rgba(0, 0, 0, .6)',
                left: 0,
                top: 0,
                zIndex: 10000
            }
        });

        setTimeout($.loadingBlockHide, 2000);
    }
    ;
});