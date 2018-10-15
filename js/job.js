$(document).ready(function (e) {

    $('#btn-job').click(function (event) {
        

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignee",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#name-id').val() || $('#name-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new consignee using this name " + $('#name').val(),
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#consignment').val() || $('#consignment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignment",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#consignment-id').val() || $('#consignment-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new consignment using this " + $('#consignment').val(),
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#chassisNumber').val() || $('#chassisNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the chassis number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#vesselAndFlight').val() || $('#vesselAndFlight').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the vessel or flight",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#vesselAndFlight-id').val() || $('#vesselAndFlight-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new vessel or flight using this " + $('#vesselAndFlight').val(),
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

    $('#edit-job').click(function () {

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignee",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#name-id').val() || $('#name-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new consignee using this name " + $('#name').val(),
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false
        } else if (!$('#consignment').val() || $('#consignment').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the consignment",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#consignment-id').val() || $('#consignment-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new consignment using this " + $('#consignment').val(),
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#chassisNumber').val() || $('#chassisNumber').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the chassis number",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#vesselAndFlight').val() || $('#vesselAndFlight').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the vessel or flight",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#vesselAndFlight-id').val() || $('#vesselAndFlight-id').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please create new vessel or flight using this " + $('#vesselAndFlight').val(),
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
 