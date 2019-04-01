$(document).ready(function () {
    $("#savebutton").click(function () {
        document.getElementById("savebutton").disabled = true;
        callLoader();
        var job, date, invoiceno;

        job = $("#job").val();
        date = $("#date").val();
//        invoiceno = $("#invoiceNumber").val();

        $.ajax({
            type: 'POST',
            data: {
                job: job,
                date: date,
//                invoiceno: invoiceno,
                option: 'CREATE'
            },
            cache: false,
            url: 'ajax/job-costing-card.php',
            success: function (result) {
                var data = [];
                var jobcostingcard, rid, vno, amount, description, type;

                jobcostingcard = result;

                $("table tbody tr").each(function (index) {
                    rid = $(this).find('.rid').attr("rid");
                    vno = $(this).find('.vno').val();
                    amount = $(this).find('.amount').val();
                    description = $(this).find('.description').val();
                    type = $(this).find('.rid').attr("type");


                    data.push({
                        jobcostingcard: jobcostingcard,
                        rid: rid,
                        vno: vno,
                        amount: amount,
                        description: description,
                        type: type
                    });
                });

                submitFormData(data);
            }
        });
    });
    function submitFormData(formData) {

        $.ajax({
            type: 'POST',
            data: {data: formData},
            cache: false,
            url: 'ajax/create-reimbursement-details.php',
            success: function (result) {
                if (result === 'false') {
                    return false;
                    
                } else {
                    window.location.replace("edit-job-costing-card.php?id="+result+"&message=10");
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