$(function () {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token

    $(".start-time").on("click", function () {
        var $button = $(this);
        var project_id = $(this).data("id");
        var user_id = $(this).data("user");
        console.log(project_id, user_id);
        $button.prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i>Proocessing');
        $.ajax({
            url: "/attendance/start/time",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            },
            data: {
                project_id: project_id,
                user_id: user_id
            },
            success: function (response) {
                if (response.success) {
                    showAlert("success", response.message);
                    $(".start-time").hide();
                    $(".end-time").show();
                } else {
                    showAlert("error", response.message);
                    $button.prop("disabled", false).html('Start Time');
                }

            },
            error: function (xhr) {
                $button.prop("disabled", false).html('Start Time');
                var errorMessage = 'Error occured while proccessing your  strt time request';
                if (xhr.status = 422) {
                    errorMessage = '';
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorMessage += value[0] + '<br>';
                    });

                    errorMessage = xhr.responseJSON.errors.project_id[0];

                } else if (xhr.status = 500) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 401) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 403) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 404) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 419) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 429) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status = 400) {
                    errorMessage = xhr.responseJSON.message;

                }
                showAlert('danger', errorMessage)
            }
        })

    });
    //end time action
    $(".end-time").on("click", function () {
        var project_id = $(this).data("id");
        var user_id = $(this).data("user");
        $button = $(this);
        $button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
        $.ajax({
            url: "/attendance/end/time",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': token // Include the CSRF token in the request headers
            },
            data: {
                project_id: project_id,
                user_id: user_id
            },
            success: function (response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $(".end-time").hide();
                    $(".start-time").show();
                } else {
                    showAlert('danger', response.message);
                    $button.prop('disabled', false).html('End Time');
                }

            },
            error: function (xhr) {
                var errorMessage = 'error occurred while requesting end time';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                showAlert('danger', errorMessage);
            }
        });//end ajax
    });//end end time action

    //Alert function
    function showAlert(type, message) {
        if (type == 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: message,
                showConfirmButton: false,
                timer: 1500
            })
        } else if (type == 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                showConfirmButton: false,
                timer: 1500
            })

        }
    }
});//end class