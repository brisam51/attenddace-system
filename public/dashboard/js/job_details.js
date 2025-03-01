$(function () {
    $(".job-link").on("click", function (e) {
        e.preventDefault();
        var userId = $(this).data("id");
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        //upload user image to top of modal
        $("#user-job-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#user-job-info").text(firstName + " " + lastName);
        //fetch job details from database
        $.ajax({
            url: "/user/job/index/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status == "success") {
                    console.log(response.data);

                }

            },
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

        $("#jobDetails-modal").show()
    });
});

