$(document).ready(function () {
    $("#btn-consignee").click(function () {

        if (!$('#consignee-name').val() || $('#consignee-name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            var name = $("#consignee-name").val();
            var address = $("#address").val();
            var vat = $("#vatNumber").val();
            var contact = $("#contactNumber").val();
            var email = $("#email").val();
            var description = $("#description").val();


            $.ajax({
                type: 'POST',
                url: 'ajax/create-consignee.php',
                dataType: "json",
                data: {
                    consignee: name,
                    address: address,
                    vatNumber: vat,
                    contactNumber: contact,
                    email: email,
                    description: description,
                    option: 'ADDCONSIGNEE'
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

                    $("#name").val(name);
                    $("#name-id").val(id);
                    $("#modal-consignee").modal('hide');

                }
            });
        }

    });

});


