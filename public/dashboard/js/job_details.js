$(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(".task-link").on("click", function (e) {
        e.preventDefault();
        var form = $("#task-details-form");
        var userId = $(this).data("id");
        var userImage = $(this).closest("tr").find(".user-image").attr("src");

        //upload user image to top of modal
        $("#user-task-image").attr("src", userImage);
        var firstName = $(this).closest("tr").find(".user-first-name").text();
        var lastName = $(this).closest("tr").find(".user-last-name").text();
        $("#user-task-info").text(firstName + " " + lastName);

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
        $("#task_title").val(''); //set task title
        $("#task_description").val(''); //set task description
        $("#task_insurance_code").val('');
        $("#date_employment").val('');
        //get task details
        $.ajax({
            url: "/user/task/index/" + userId,
            method: "GET",
            success: function (response) {
                if (response.status == "success") {
                    $("#task-id").val(response.data.id)
                    $("#task_title").val(response.data.task_title); //set task title
                    $("#task_description").val(response.data.task_description); //set task description
                    $("#task_insurance_code").val(response.data.task_insurance_code);
                    $("#date_employment").val(response.data.date_employment);
                    //update current  record
                    form.on("submit", function (e) {
                        e.preventDefault();

                        var updateData = {
                            id: $("#task-id").val(),
                            task_title: $("#task_title").val(),
                            task_description: $("#task_description").val(),
                            task_insurance_code: $("#task_insurance_code").val(),
                            date_employment: $("#date_employment").val(),
                            user_id: userId,

                        };
                        //Update Current record.*

                        $.ajax({
                            url: "/user/task/update/" + userId,
                            method: "PUT",
                            data: updateData,
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            success: function (response) {
                                if (response.status == "success") {
                                    alert("task updated successfully");
                                    $("#task-modal").hide();
                                } else {
                                    alert("task updated Fails");
                                }
                            },
                            error: function (xhr) {
                                var errorMessag = "Failed to fetch data  :\n";
                                console.log(errorMessag + xhr.responseText);
                            }

                        }); //end of ajax
                    });
                } else {
                    form.on("submit", function () {
                        var insertData = {
                            task_title: $("#task_title").val(),
                            task_description: $("#task_description").val(),
                            task_insurance_code: $("#task_insurance_code").val(),
                            date_employment: $("#date_employment").val(),
                            user_id: userId,
                        };
                        $.ajax({
                            url: "/user/task/create",
                            method: "POST",
                            data: insertData,
                            headers: {
                                'X-CSRF-Token': csrfToken // Add CSRF token to headers
                            },
                            success: function (response) {
                                if (response.status == "success") {
                                    alert("task created successfully");
                                    $("#task-modal").hide();
                                } else {
                                    alert("Failed to create task");
                                }
                            },
                            error: function (xhr) {
                                var errorMessag = "Failed to fetch data  :\n";
                                console.log(errorMessag + xhr.responseText);
                            }
                        });
                    });
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


        $("#task-modal").show();
    });
    $("#close-task-amodal").on("click", function () {
        $("#task-modal").hide();
    });
});
