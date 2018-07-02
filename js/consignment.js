$(document).ready(function () {

    $('#create-consignment').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            return true;
        }

    });

    $('#edit-consignment').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
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
 