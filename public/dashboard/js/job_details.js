$(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(".job-link").on("click", function (e) {
        e.preventDefault();
        var form = $("#job-details-form");
        var userId = $(this).data("id");
        var userImage = $(this).closest("tr").find(".user-image").attr("src");

        //upload user image to top of modal
        $("#user-job-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#user-job-info").text(firstName + " " + lastName);

        $("#date_employment").persianDatepicker({
            format: "YYYY/MM/DD",
            //observer: true,
            onSelect: function (unixTimestamp) {
                const persiandate = $("#date_employment").val();
                //convert persian data to gregorian date
                const gregorianDate = moment(persiandate, "jYYYY/jM/jD").format("YYYY-MM-DD");
                //set gregorian date to input
                $("#gregorianDate").val(gregorianDate);

            }
        });

        //clear Textfields
        $("#job_title").val(''); //set job title
        $("#job_description").val(''); //set job description
        $("#job_insurance_code").val('');
        $("#date_employment").val('');
        //get job details
        $.ajax({
            url: "/user/job/index/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status == "success") {
                    $("#job-id").val(response.data.id)
                    $("#job_title").val(response.data.job_title); //set job title
                    $("#job_description").val(response.data.job_description); //set job description
                    $("#job_insurance_code").val(response.data.job_insurance_code);
                    $("#date_employment").val(response.data.date_employment);
                    //update current  record
                    form.on("submit", function (e) {
                        e.preventDefault();
                        //gregorianDate
                        

                        //Update Current record.*

                        $.ajax({
                            url: "/user/job/update" + userId,
                            method: "PUT",
                            data: formData,
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            success: function (response) {
                                if (response.status == "success") {
                                    alert("Job updated successfully");
                                    $("#jobDetails-modal").hide();
                                } else {
                                    alert("Job updated Fails");
                                }
                            },
                            error: function (xhr) {
                                var errorMessag = "Failed to fetch data  :\n";
                                console.log(errorMessag + xhr.responseText);
                            }

                        }); //end of ajax
                    });
                }else{
                   form.on("submit",function(){
                    var formData = {
                        job_title: $("#job_title").val(),
                        job_description: $("#job_description").val(),
                        job_insurance_code: $("#job_insurance_code").val(),
                        date_employment: $("#date_employment").val(),
                        user_id:userId,
                    };
                    $.ajax({
                        url:"/user/job/create",
                        method:"POST",
                        data:formData,
                        headers: {
                            'X-CSRF-Token': csrfToken // Add CSRF token to headers
                        },
                        success: function (response) {
                            if (response.status == "success") {
                                alert("Job created successfully");
                                $("#jobDetails-modal").hide();
                            } else {
                                alert("Failed to create job");
                            }
                        },
                        error: function (xhr) {
                            var errorMessag = "Failed to fetch data  :\n";
                            console.log(errorMessag + xhr.responseText);
                        }
                    });
                   }) ;
                }
              



            },//end sucess
            erorr: function (xhr) {
                var errorMessag = "Failed to fetch data  :\n";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessag += xhr.responseJSON.message;
                } else {
                    alert(
                        (errorMessag +=
                            "An unknown error occurred. Please try again later.")
                    );
                }
                alert(errorMessag);
            },

        });


        $("#jobDetails-modal").show();
    });
    $("#close-job-amodal").on("click", function () {
        $("#jobDetails-modal").hide();
    });
});
