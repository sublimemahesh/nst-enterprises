$(document).ready(function () {
    $('#create-account').click(function (e) {
        e.preventDefault();
        if (!$('#startdate').val() || $('#startdate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the start date",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#enddate').val() || $('#enddate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the end date",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            
            $.ajax({
                type: 'POST',
                url: 'ajax/account.php',
                dataType: 'json',
                data: {option: 'GETACTIVEACCOUNT'},
                success: function (result) {
                    if (result === true) {
                        $('#form-account').submit();
                    } else {
                        swal({
                            title: "Error!",
                            text: "Please close the current account",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        return false;
                    }

                }
            });
        }
    });
    $('#edit-account').click(function () {

        if (!$('#startdate').val() || $('#startdate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the start date",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#enddate').val() || $('#enddate').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the end date",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            callLoader();
            return true;
        }
    });
});

//