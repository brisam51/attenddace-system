$(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(".job-link").on("click", function (e) {
        e.preventDefault();
        var userId = $(this).data("id");
        var userImage = $(this).closest("tr").find(".user-image").attr("src");
        var form=$("#job-info-form");
        //upload user image to top of modal
        $("#user-job-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#user-job-info").text(firstName + " " + lastName);
        $("#persainDate").persianDatepicker({
            format: "YYYY/MM/DD",
            //observer: true,
            onSelect: function (unixTimestamp) {
                const persiandate = $("#persianDate").val();
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
                    $("#job_title").val(response.data.job_title); //set job title
                    $("#job_description").val(response.data.job_description); //set job description
                    $("#job_insurance_code").val(response.data.job_insurance_code);
                    $("#date_employment").val(response.data.date_employment);
                    //update current record
                    form.on("submit",function(){


                        var formData = {

                            job_title: $("#job_title").val(),
                            job_description: $("#job_description").val(),
                            job_insurance_code: $("#job_insurance_code").val(),
                           // date_employment: $("#gregorianDate").val(),
                        };
                        $.ajax({
                            url: "/user/job/update/"+userId,
                            method: "PUT",
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            data: formData,
                            success: function (response) {
                                if (response.status == "success") {
                                    alert("Job updated  successfully");
                                } else{
                                    alert("Job update failed");
                                }
                            },
                            error: function (xhr) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessage = "Update failed :\n";
                                for (var key in errors) {
                                    // if (errors.hasOwnProperty(key)) {
                                    //     errorMessage += errors[key].join("\n") + "\n";
                                    // }
                                }//end for lop
                                alert(errorMessage)
                            }
                        });


                    });
                } else {
                    //insert new record
                    form.on("submit",function(){
                        var formData = {
                            user_id: userId,
                            job_title: $("#job_title").val(),
                            job_description: $("#job_description").val(),
                            job_insurance_code: $("#job_insurance_code").val(),
                            date_employment: $("#gregorianDate").val(),
                        };
                        $.ajax({
                            url: "/user/job/create",
                            method: "POST",
                            data: formData,
                            success: function (response) {
                                if (response.status == "success") {
                                    alert("Job details added successfully");
                                } else{}
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
                        });


                    }); //set form submit



                }//end success else

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

