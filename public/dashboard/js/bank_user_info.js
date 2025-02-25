$(function(){
var modal=$("#bank-modal");
var form=$("#bankInfoForm");

    $(".bank_info_link").on('click', function(event){
        event.preventDefault();
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        //upload user image to top of modal
        $("#bank-user-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
                var lastName = $(this).closest("tr").find(".user-last-name").text();
                   $("#user-info").text(firstName + " " + lastName);


       $("#bank-modal").show();
        // display bank user info modal
               // fetch current user info from server
        // populate bank user info form with retrieved data
        // enable/disable form fields as needed
        // update bank user info form with current user info
        // enable/disable form fields as needed
        // handle form submission to update bank user info
    });

    $("#close-bank-amodal").on("click", function () {
        $("#bank-modal").hide();
    });
}); // end of document ready
