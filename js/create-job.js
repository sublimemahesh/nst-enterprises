$(document).ready(function () {
    $('#btn-job').click(function () {
        if (!$('#name-id').val() || $('#name-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new consignee using this name.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
    });
});