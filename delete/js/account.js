$(document).ready(function () {
    $('.delete-account').click(function () {

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
                url: "delete/ajax/account.php",
                type: "POST",
                data: {id: id, option: 'delete'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Deleted!",
                            text: "Account has been deleted.",
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
    
    $('.clear-account').click(function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "Are you want to clear this account?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Clear it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: "delete/ajax/account.php",
                type: "POST",
                data: {id: id, option: 'clear'},
                dataType: "JSON",
                success: function (jsonStr) {
                    if (jsonStr.status) {

                        swal({
                            title: "Cleared!",
                            text: "Account has been cleared.",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        location.reload();

                    }
                }
            });
        });
    });
});




