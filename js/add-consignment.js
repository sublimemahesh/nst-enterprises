$(document).ready(function () {
    $("#btn-consignment").click(function () {
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
                var id = result.id;
                var name = result.name;
                
                $("#consignment").val(name);
                $("#consignment-id").val(id);
                $("#modal-consignment").modal('hide');
                
//                var consignee = $("#name").val();
                
//                if(consignee) {
//                    $("#btn-job").removeAttr('disabled','');
//                }
                
                
                
            }
        });

    });

});


