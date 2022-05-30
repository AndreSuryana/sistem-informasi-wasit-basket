$(document).ready(function() {

    $('#form-register').on('submit', function(event) {

        // Prevent default
        event.preventDefault();

        // Get input value
        var firstName = $("#first_name").val();
        var lastName = $("#last_name").val();
        var fullName = $("#full_name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $('#confirm_password').val();

        // Input validation
        if (firstName.length == "") {
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nama depan tidak boleh kosong!'
            });
        }

        if (lastName.length == "") {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Nama belakang tidak boleh kosong!'
            });
        }

        if (fullName.length == "") {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Nama lengkap tidak boleh kosong!'
            });
        }

        if (email.length == "") {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Email tidak boleh kosong!'
            });
        }

        if (password.length == "") {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Password tidak boleh kosong!'
            });
        }

        if (password.length < 8) {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Password tidak boleh kurang dari 8 karakter!'
            });
        }

        if (confirmPassword.length == "") {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Konfirmasi password tidak boleh kosong!'
            });
        }

        if (confirmPassword.length < 8) {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Konfirmasi password tidak boleh kurang dari 8 karakter!'
            });
        }

        if (password != confirmPassword) {
            return Swal.fire({
                icon: 'warning',
                type: 'warning',
                title: 'Oops..',
                text: 'Konfirmasi password tidak sama dengan password!'
            });
        }

        // TODO : Tambahin validasi 'must contains number'

        // Ajax: post-register
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('data-action'),
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    return Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Akun berhasil terdaftar! Silahkan masuk untuk melanjutkan',
                    }).then(function(result) {
                        window.location = '/login';
                    });
                } else {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Akun gagal terdaftar!'
                    })
                }
            },
            error: function(response) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.responseText['error']
                });
            },
            statusCode: {
                400: function(response) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Bad request!'
                    });
                },
                500: function(response) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Internal server error!'
                    });
                }
            }
        });
    });
});