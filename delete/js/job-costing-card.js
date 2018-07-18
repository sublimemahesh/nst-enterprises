$(document).ready(function () {
    $('.delete-job-costing-card').click(function () {

        var id = $(this).attr("data-id");
        var place = $(this).attr("place");
        if (place === 'consignee') {
            var consignee = $(this).attr("consignee");
        }

        swal({
            title: "Are you sure?",
            text: "You will not be able to recover!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "delete/ajax/job-costing-card.php",
                type: "POST",
                data: {id: id, option: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Deleted!",
                            text: "Job costing card has been deleted.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                        if (place === 'edit') {
                            window.location.replace("manage-job-costing-cards.php");
                        } else if (place === 'consignee') {

                            window.location.replace("manage-consignee-jobs.php?id="+consignee);
                        }

                    }
                }
            });
        });
    });
});


