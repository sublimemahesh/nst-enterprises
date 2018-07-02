$(document).ready(function () {

    $('#btn-job').click(function () {

        if (!$('#name-id').val() || $('#name-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignee",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#consignment-id').val() || $('#consignment-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignment",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#description').val() || $('#description').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the description",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#chassisNumber').val() || $('#chassisNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the chassis number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#vesselAndFlight').val() || $('#vesselAndFlight').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the vessel or flight",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            return true;
        }

    });
    
    $('#edit-job').click(function () {

        if (!$('#name-id').val() || !$('#name').val() || $('#name-id').val().length === 0 || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignee",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#consignment-id').val() || !$('#consignment').val() || $('#consignment-id').val().length === 0 || $('#consignment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignment",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#description').val() || $('#description').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the description",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#chassisNumber').val() || $('#chassisNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the chassis number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#vesselAndFlight').val() || $('#vesselAndFlight').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the vessel or flight",
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
 