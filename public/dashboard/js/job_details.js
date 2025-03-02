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
        $("#persainDate").persianDatepicker({
           format:"YYYY/MM/DD",
           //observer: true,
          onSelect:function(unixTimestamp){
           const persiandate =  $("#persianDate").val();
           //convert persian data to gregorian date
           const gregorianDate = moment(persiandate, "jYYYY/jM/jD").format("YYYY-MM-DD");
           //set gregorian date to input
           $("#gregorianDate").val(gregorianDate);

          }
        });



        $.ajax({
            url: "/user/job/index/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status == "success") {
                    console.log(response.data);

                    $("#job_title").val(response.data.job_title); //set job title
                    $("#job_description").val(response.data.job_description); //set job description
                    $("#job_insurance_code").val(response.data.job_insurance_code);
                    $("#persianDate").val(response.data.persianDate);
                } else {
                    //
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

