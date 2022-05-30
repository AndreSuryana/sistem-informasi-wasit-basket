$(document).ready(function() {

    $('#form-login  ').on('submit', function(event) {

        // Prevent default
        event.preventDefault();

        // Get input value
        var email = $('#email').val();
        var password = $('#password').val();

        // Input validation
        if (email.length == "") {
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Email tidak boleh kosong'
            });
        }

        if (password.length == "") {
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Password tidak boleh kosong'
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

        // Ajax: post-login
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
                console.log(response);
                if (response.success) {
                    window.location = '/dashboard'
                } else {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.responseText['error']
                    });
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
                    var responseJson = JSON.parse(response.responseText)
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: responseJson.error
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
    })
});