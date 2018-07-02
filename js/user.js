$(document).ready(function () {

    $('#btn-user').click(function () {

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#username').val() || $('#username').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the username",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#password').val() || $('#password').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the password",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#cpassword').val() || $('#cpassword').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the confirm password",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;

        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "Please enter a valid email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else {
            if ($('#password').val() == $('#cpassword').val()) {
                return true;
            } else {
                swal({
                    title: "Error!",
                    text: "Password and confirm password is not matched",
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
                return false;
            }

        }

    });

    $('#edit-user').click(function () {

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your email",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        } else if (!emailReg.test($('#email').val())) {
            swal({
                title: "Error!",
                text: "Please enter a valid email",
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
 