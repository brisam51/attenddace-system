$(function () {
    //indicate on address link in User table
    $(".address-user").on("click", function () {

        var modal = $("#address-modal");
        var form = $("#address-form");
        var saveButton = $("#saveButton");
        var userId = $(this).data("id");
        var createUrl = "user/address/store";


        //Fetchthe user image from user table
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        //upload user image to top of modal
        $("#modal-user-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#modal-user-name").text(firstName + " " + lastName);
        // start Fetch address details for this user

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
                } else {
                    alert(response.message);
                }
                modal.show();
            }, //end success
            error: function (response) {
                alert(response.responseJSON.message);
                            modal.show();
            },
        });
        //end Fetch address details for this user

        //Start Submition

        //End  Submition


    });
}); //end script
