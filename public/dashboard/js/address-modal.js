$(function () {
    //indicate on address link in User table
    $(".address-user").on("click", function () {
        var modal = $("#address-modal");
        var form = $("#addressForm");
        var saveButton = $("#saveButton");
        form.trigger("reset");
        saveButton.text("save");
        var userId = $(this).data("id");
        var updateUrl = "user/address/update/" + userId;
        var createUrl = "user/address/update/" + userId;
        //Fetchthe user image from user table
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        //upload user image to top of modal
        $("#modal-user-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#modal-user-name").text(firstName + " " + lastName);
        //Fetch address details for this user

        $.ajax({
            url: "/user/address/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status === "success") {
                    $("#address_id").val(response.data.id);
                    $("#form-mobile").val(response.data.mobile);
                    $("#form-phone").val(response.data.phone);
                    $("#form-address").val(response.data.address);
                    $("#user_id").val(response.data.user_id);
                    //change save button text to Update
                    saveButton.text(" update");
                    $("#isUpdate").text("isupdate");
                    modal.hide();
                } else {
                    alert(response.message);
                    saveButton.text("save");
                    $("#isUpdate").text("issave");
                }
                modal.show();
            }, //end success
            error: function (response) {
                alert(response.responseJSON.message);
                saveButton.text("ذخیره");
                modal.show();
            },
        });

        //Hand over form submission to modal save button
        form.on("submit", function (event) {
            event.preventDefault();

            isUpdate = $("#isUpdate").text(); //Detrmine if the form is for creating or updating an address

            if (isUpdate.text === "isupdate") {
                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    success: function (response) {
                        if (response.status === "success") {
                            alert(response.message);
                            modal.hide();
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }, //end success
                    error: function (xhr) {
                        var response = xhr.responseJSON;
                        if (response && response.status === "error") {
                            // Display validation errors
                            if (response.errors) {
                                for (var field in response.errors) {
                                    $("#" + field + "_error")
                                        .text(response.errors[field][0])
                                        .show();
                                }
                            }
                        } else {
                            alert(
                                "There was an error processing your request."
                            );
                        }
                    },
                });
            } else {
            }

            // var method = "post";
            // var csrfToken = $('meta[name="csrf-token"]').attr("content");
            //preparing form data for sending to server
            // var formData = {
            //     _token: csrfToken,
            //     user_id: userId,
            //     mobile: $("#form-mobile").val(),
            //     phone: $("#form-phone").val(),
            //     address: $("#form-address").val(),
            // };
        });

        //     });
        // });
        // $("#close-amodal").on("click", function () {
        //     $("#address-modal").hide();
        // }); var url =
    });
}); //end script
