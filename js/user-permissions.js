$(document).ready(function () {
    callLoader();
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

        setTimeout($.loadingBlockHide, 2000);
    };
});


