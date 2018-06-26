$(document).ready(function () {
    var userid = $('#userid').val();
    $.ajax({
        type: 'POST',
        url: 'ajax/user-permissions.php',
        dataType: "json",
        data: {
            id: userid,
            option: 'GETUSERPERMISSIONS'
        },
        success: function (userpermissions) {

            $.each(userpermissions, function (key, userpermission) {
                $('#permission-' + userpermission).attr("checked", "checked");
            });
        }
    });
});


