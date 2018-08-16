$(document).ready(function () {

    $('#create-payment').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#payment').val() || $('#payment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the payment",
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

    $('#edit-payment').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the customer name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#payment').val() || $('#payment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the payment",
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

        setTimeout($.loadingBlockHide, 1000);
    }
    ;

});
 