$(document).ready(function () {
    $('.delete-job').click(function () {

        var id = $(this).attr("data-id");

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
                url: "delete/ajax/job.php",
                type: "POST",
                data: {id: id, option: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status == 'accessdenied') {
                        swal({
                            title: "Access Denied!",
                            text: "You do not have permission to delete this job.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (jsonStr.status === true) {

                        swal({
                            title: "Deleted!",
                            text: "Job has been deleted.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#row_' + id).remove();

                    }
                }
            });
        });
    });
});


