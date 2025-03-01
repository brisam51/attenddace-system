$(function () {
    var modal = $("#bank-modal");
    var form = $("#bank-info-form");
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Adjust this based on your framework

    $(".bank_info_link").on('click', function (event) {

        event.preventDefault();
        var userId = $(this).data("id");
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        //upload user image to top of modal
        $("#user-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#user-info").text(firstName + " " + lastName);
        $("#bank-user-modal").show();

        $.ajax({
            url: "/user/bank/index/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status === "success") {

                    $("#bank-id").val(response.data.id);
                    $("#account_number").val(response.data.account_number);
                    $("#bank_name").val(response.data.bank_name);
                    $("#shaba_number").val(response.data.shaba_number);

                    $("#save-bank-button").text("Update");
                    //update curent record via ajax
                    form.on("submit", function (e) {
                        e.preventDefault();

                        var formData = {
                            user_id: userId,
                            id: $("#bank-id").val(),
                            account_number: $("#accuont_number").val(),
                            bank_name: $("#bank_name").val(),
                            shaba_number: $("#shaba_number").val(),
                        };

                        $.ajax({
                            url: "/user/bank/update/" + userId,
                            method: "PUT",
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            data: formData,
                            success: function (response) {
                                if (response.status === "success") {
                                    alert("Record updated successfully");
                                    //hide modal
                                    $("#bank-user-modal").hide();
                                } else {
                                    alert("Record updated failed" + response.message);
                                }
                            },

                            error: function (xhr) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessage = "Update failed :\n";
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessage += errors[key].join("\n") + "\n";
                                    }
                                }//end for lop
                                alert(errorMessage)
                            }

                        });//end ajax

                    });//end update submtion
                } else {
                    //try to insert new user bank info


                    form.on("submit", function (e) {
                        e.preventDefault();
                        var insertData = {
                            user_id: userId,//user id
                            account_number: $("#account_number").val(),
                            bank_name: $("#bank_name").val(),
                            shaba_number: $("#shaba_number").val(),
                        };

                        $.ajax({
                            url: "/user/bank/store",
                            method: "POST",

                            data: insertData,
                            headers: {
                                'X-CSRF-Token': csrfToken
                            },
                            success: function (response) {
                                if (response.status === "success") {
                                    // Display success message and hide the modal
                                    alert(response.message); // Consider replacing with a more user-friendly notification
                                    $("#bank-user-modal").hide();
                                } else {
                                    // Display failure message
                                    alert(response.message);
                                }
                            },
                            error: function (xhr) {
                                try {
                                    // Parse error details from the response
                                    var errors = xhr.responseJSON.errors;

                                        if (response.errors) {
                                            for (var field in response.errors) {
                                                $('#' + field + '_error').text(response.errors[field][0]).show();
                                            }
                                        }else {

                                        // Handle cases where the server does not return a valid JSON response
                                        alert("An unexpected error occurred. Please try again later.");
                                    }
                                } catch (e) {
                                    // Catch any unexpected errors during error handling
                                    alert("An error occurred while processing your request. Please try again later.");
                                }
                            }

                        });
                       // End of AJAX call
                    }); // End of form submit event listener//end submitform


                }
            },//end success sction
            //================handel error when fetching data==========================
            erorr: function (xhr) {
                var errorMessag = "Failed to fetch data  :\n";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessag += xhr.responseJSON.message;
                } else {
                    alert(errorMessag += "An unknown error occurred. Please try again later.");

                }
                alert(errorMessag);
            }
        });

    });


    $("#close-bank-amodal").on("click", function () {

        $("#bank-user-modal").hide();
    });
}); // end of document ready
