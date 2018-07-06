$(document).ready(function () {

    $('#create-job-costing-card').click(function () {

        if (!$('#job').val() || $('#job').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the job id",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#invoiceNumber').val() || $('#invoiceNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the invoice number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            return true;
        }

    });

    $('#edit-job-costing-card').click(function () {

        if (!$('#job').val() || $('#job').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the job id",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#invoiceNumber').val() || $('#invoiceNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the invoice number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            return true;
        }

    });

});


