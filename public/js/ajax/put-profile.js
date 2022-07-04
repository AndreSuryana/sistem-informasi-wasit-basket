$(document).ready(function() {

    $('#form-profile').on('submit', function(event) {

        // Prevent default
        event.preventDefault();

        // Get input value
        var firstName = $("#first_name").val();
        var lastName = $("#last_name").val();
        var fullName = $("#full_name").val();
        var email = $("#email").val();
        var gender = $("#gender:checked").val();
        var placeOfBirth = $("#place_of_birth").val();
        var dateOfBirth = $("#date_of_birth").val();
        var phone = $("#phone").val();
        var address = $("#address").val();
        var cityId = $("#select-city").find(':selected').val();
        var otherProfession = $("#other_profession").val();
        // var photo = $("#photo").prop('files')[0];

        // Create new form data
        // var formData = new FormData(this);

        // Input validation
        if (firstName.length == "") {
            $("#first_name").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nama depan tidak boleh kosong!'
            });
        }

        if (lastName.length == "") {
            $("#last_name").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nama belakang tidak boleh kosong!'
            });
        }

        if (fullName.length == "") {
            $("#full_name").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nama lengkap tidak boleh kosong!'
            });
        }

        if (email.length == "") {
            $("#email").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Email tidak boleh kosong!'
            });
        }

        if (placeOfBirth.length == "") {
            $("#place_of_birth").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Tempat lahir tidak boleh kosong!'
            });
        }

        if (dateOfBirth.length == "") {
            $("#date_of_birth").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Tanggal lahir tidak boleh kosong!'
            });
        }

        if (phone.length == "") {
            $("#phone").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nomor telepon tidak boleh kosong!'
            });
        }

        if (!$.isNumeric(phone)) {
            $("#phone").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Nomor telepon harus berupa angka!'
            });
        }

        if (address.length == "") {
            $("#address").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Alamat tidak boleh kosong!'
            });
        }

        if (cityId == 0) {
            $("#select-city").focus();
            return Swal.fire({
                icon: 'warning',
                title: 'Oops..',
                text: 'Mohon pilih Kabupaten/Kota!'
            });
        }

        if (otherProfession.length == "") {
            otherProfession = null;
        }

        // if ($("#photo-input").val() === "") {
        //     $("#photo-input").focus();
        //     return Swal.fire({
        //         icon: 'warning',
        //         title: 'Oops..',
        //         text: 'Wajib mengupload foto!'
        //     });
        // }

        // if (photo.size > 2000000) {
        //     $("#photo").focus();
        //     return Swal.fire({
        //         icon: 'warning',
        //         title: 'Oops..',
        //         text: 'Foto maksimal berukuran 2 MB!'
        //     });
        // }

        // $("#photo").change(function() {
        //     var fileExtension = ['jpeg', 'jpg', 'png'];
        //     if ($.inArray($(this).val().lastIndexOf('.').pop().toLowerCase(), fileExtension) == -1) {
        //         $("#photo").focus();
        //         return Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops..',
        //             text: "Foto harus berformat " + fileExtension.join('/') + "!"
        //         });
        //     }
        //     if ($("#photo").prop('files')[0].size > 2000000) {
        //         $("#photo").focus();
        //         return Swal.fire({
        //             icon: 'warning',
        //             title: 'Oops..',
        //             text: 'Foto maksimal berukuran 2 MB!'
        //         });
        //     }
        // });

        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ', ' + pair[1]);
        // }

        // Ajax: put-profile
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('data-action'),
            // data: $(this).serialize(),
            data: {
                first_name: firstName,
                last_name: lastName,
                full_name: fullName,
                email: email,
                gender: gender,
                place_of_birth: placeOfBirth,
                date_of_birth: dateOfBirth,
                phone: phone,
                address: address,
                city_id: cityId,
                other_profession: otherProfession,
            },
            dataType: "JSON",
            success: function(response) {
                if (response.success) {
                    return Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data diri berhasil disimpan.',
                    }).then(function(result) {
                        return window.location = '/profile/data';
                    });
                } else {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data!'
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
                    console.log(response);
                    return Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.responseJSON.error
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