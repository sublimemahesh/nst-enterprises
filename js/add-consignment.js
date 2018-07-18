$(document).ready(function () {
    $("#btn-consignment").click(function () {

        if (!$('#consignment-name').val() || $('#consignment-name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var name = $("#consignment-name").val();
            var description = $("#description1").val();

            $.ajax({
                type: 'POST',
                url: 'ajax/create-consignment.php',
                dataType: "json",
                data: {
                    consignment: name,
                    description: description,
                    option: 'ADDCONSIGNMENT'
                },
                success: function (result) {
                    swal({
                        title: "Success!",
                        text: "Your data was saved successfully.",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    var id = result.id;
                    var name = result.name;

                    $("#consignment").val(name);
                    $("#consignment-id").val(id);
                    $("#modal-consignment").modal('hide');
                }
            });
        }
    });

});


