$(document).ready(function () {
    $("#btn-consignee").click(function () {
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
                var id = result.id;
                var name = result.name;
                
                $("#name").val(name);
                $("#name-id").val(id);
                $("#modal-consignee").modal('hide');
                
//                var consignment = $("#consignment").val();
                
//                if(consignment) {
//                    $("#btn-job").removeAttr('disabled','');
//                }
                
            }
        });

    });

});


