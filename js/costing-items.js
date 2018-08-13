$(document).ready(function () {

    $('#create-costing-item').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the title",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#type').val() || $('#type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the type",
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

    $('#edit-costing-item').click(function () {

        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the title",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#type').val() || $('#type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the type",
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
 