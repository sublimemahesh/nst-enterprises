$(document).ready(function () {
    $("#btn-vessel-or-flight").click(function () {

        if (!$('#vesselorFlight-name').val() || $('#vesselorFlight-name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#vesselorFlight-type').val() || $('#vesselorFlight-type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select the type",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var name = $("#vesselorFlight-name").val();
            var type = $("#vesselorFlight-type").val();

            $.ajax({
                type: 'POST',
                url: 'ajax/create-vessel-or-flight.php',
                dataType: "json",
                data: {
                    vesselorflight: name,
                    type: type,
                    option: 'ADDVESSELORFLIGHT'
                },
                success: function (result) {
                    swal({
                        title: "Error!",
                        text: "Your data was saved successfully.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    var id = result.id;
                    var name = result.name;

                    $("#vesselAndFlight").val(name);
                    $("#vesselAndFlight-id").val(id);
                    $("#modal-vesselorflight").modal('hide');
                }
            });
        }





    });

});


