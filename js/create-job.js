$(document).ready(function () {

    $('#btn-job').click(function () {
        
//        var description = tinyMCE.get('description').getContent(), patt;
//        patt = /^<p>(&nbsp;\s)+(&nbsp;)+<\/p>$/g;

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
            alert($('#description').val());
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
 