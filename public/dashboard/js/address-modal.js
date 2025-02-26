$(function () {
    var form = $("#address-form");
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Adjust this based on your framework

    // Call address links from datatable
    $(".user-address").on("click", function () {
        var userId = $(this).data("id");

        // Fetch address details for this user
        $.ajax({
            url: "/user/address/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status === "success") {
                    $("#address-id").val(response.data.id);
                    $("#form-mobile").val(response.data.mobile);
                    $("#form-phone").val(response.data.phone);
                    $("#form-address").val(response.data.address);
                    $("#save-button").text("بروز رسانی")
                    // Handle form submission
                    form.on("submit", function (event) {
                        event.preventDefault(); // Prevent default form submission

                        // Prepare form data
                        var formData = {
                            user_id: userId,
                            id: $("#address-id").val(),// Include user_id in the form data
                            mobile: $("#form-mobile").val(),
                            phone: $("#form-phone").val(),
                            address: $("#form-address").val(),
                        };

                        // Send data via AJAX
                        $.ajax({
                            url: "/user/address/update/" + userId,
                            method: 'PUT',
                            data: formData,
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            success: function (response) {
                                if (response.status === "success") {
                                    alert(response.message);
                                    $("#address-modal").hide();
                                } else {
                                    alert("Error Happened");
                                }
                            },
                            error: function (xhr) {
                                var response = xhr.responseJSON;
                                if (response && response.status === "error") {
                                    // Display validation errors
                                    alert(response.message);
                                    if (response.errors) {
                                        for (var field in response.errors) {
                                            $('#' + field + '_error').text(response.errors[field][0]).show();
                                        }
                                    }
                                } else {
                                    alert('There was an error processing your request.');
                                }
                            }
                        });
                    });
                } else {
                    $("#save-button").text("ذخیره");
                    $("#form-mobile").val('');
                    $("#form-phone").val('');
                    $("#form-address").val('');
                    //Insert new user Address
                    form.on("submit", function () {
                        var formData = {
                            user_id: userId,
                            mobile: $("#form-mobile").val(),
                            phone: $("#form-phone").val(),
                            address: $("#form-address").val(),
                        }
                        $.ajax({
                            url: "/user/address/store",
                            method: 'POST',
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            data: formData,
                            success: function (response) {
                                if (response.status === "success") {
                                    alert(response.message);
                                    $("#address-modal").hide();
                                }
                            },
                            error: function (xhr) {
                                var response = xhr.responseJSON;
                                if (response && response.status === "error") {
                                    // Display validation errors
                                    alert(response.message);
                                    if (response.errors) {
                                        for (var field in response.errors) {
                                            $('#' + field + '_error').text(response.errors[field][0]).show();
                                        }
                                    }
                                } else {
                                    alert('There was an error processing your request.');
                                }
                            }
                        });//end  ajax of insert new addres
                    });
                }
            },
            error: function (response) {
                alert(response.message);
            }
        }); // End fetch data AJAX

        // Show the modal
        $("#address-modal").show();
    });

    // Close modal
    $("#close-amodal").on("click", function () {
        $("#address-modal").hide();
    });
}); // End scripts
