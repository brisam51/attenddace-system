$(function () {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token
    //hlper function for AJAX calls
    function handleAttendanceAction(url, button, projectId, userId, successCallback) {
        const originalText=button.data('original-text')||button.text();
       // button.prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Processing');
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                project_id: projectId,
                user_id: userId
            },
            success: function (response) {
                if (response.success) {
                    successCallback(response);
                } else {
                    showAlert('error', response.message);
                   // restButton(button, originalText);
                }

            },
            error: function (xhr) {
                var errorMessage = 'An error occurred. Please try again later.';
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                    }
                } else if (xhr.status === 0) {
                    errorMessage = 'No internet connection';
                }
                showAlert('error', errorMessage);
              // restButton(button, originalText);
            }//end of error
        });
    }

    //Reset button to original state
    function restButton(button, originalText) {
       // button.prop('disabled',false).html(originalText);
    }


    //store original button text on elements
    $(".start-time,.end-time").each(function () {
        $(this).data('original-text', $(this).text());
    }
    );
    //Alert function
    function showAlert(type, message,timer=2500) {
        const config={ icon: type,
            title: type.charAt(0).toUpperCase() + type.slice(1),
            text: message,
            showConfirmButton: false,
            timer: timer
        };
        if (type === 'error') {
            config.icon = 'error';
            config.title = 'Error';
        }
       
      
    }//end of alert function

    //start attendance
    $(".start-time").on('click', function () {
        const $button = $(this);
        const projectId = $button.data('id');
        const userId = $button.data('user');
        //attendance/start/time
        handleAttendanceAction('/attendance/start/time', $button, projectId, userId, function (response) {
            showAlert('success', response.message);
            //Update UI for new session
           // $button.hide();
           // $button(`.end-time[data-id="${projectId}"]`).show();
           $(`.end-time[data-id="${projectId}"]`).show();
            //update button with start time
           // $button(`.start-time[data-id="${projectId}"]`).text(response.data.start_time);
        });
    });
    //end attendance
 $(".end-time").on('click',function () {
        const $button = $(this);
        const projectId= $button.data('id');
        const userId = $button.data('user');
        //attendance/end/time
        handleAttendanceAction('/attendance/end/time', $button, $button.data('id'), $button.data('user'), function (response) {
           let message = response.message;
           //Add work duration to message
           if(response.data&& response.data.total_minutes){
            const hours=Math.floor(response.data.total_minutes/60);
            const minutes=response.data.total_minutes%60;   
            message+=`(Worked: ${hours}h:${minutes}m)`;
           }
           showAlert('success', message,3500);
           //update UI
          // $button.hide();
           $(`.start-time[data-id="${projectId}"]`).show();
           //Refrsh daily saummery
           fetchDailySummary(userId);

        });
            
        });
//Fetch and display daily summary
function fetchDailySummary(userId){
    $.ajax({
        url: `/attendance/daily/summary/${userId}`,
        method: 'GET',
        success: function (response) {
           if(response.success){
            updateSummaryDisplay(response.data);
        }
    },
    error: function () {
        console.log('Error fetching daily summary');   
    }
    });
}

//Update the UI with daily summary data
 // Update the UI with daily summary data
 function updateSummaryDisplay(data) {
    // Example implementation - adjust to your HTML structure
    const summaryElement = $('#daily-summary');
    if (summaryElement.length) {
        let html = `
            <div class="summary-card">
                <h4>Today's Work Summary</h4>
                <p>Total Projects: ${data.total_projects}</p>
                <p>Total Time: ${data.total_hours}h ${data.total_minutes}m</p>
                <ul class="project-list">
        `;
        
        data.attendances.forEach(attendance => {
            const hours = Math.floor(attendance.total_time / 60);
            const minutes = attendance.total_time % 60;
            
            html += `
                <li>
                    ${attendance.project.title}: 
                    ${hours}h ${minutes}m (${attendance.start_time} - ${attendance.end_time})
                </li>
            `;
        });
        
        html += `</ul></div>`;
        summaryElement.html(html);
    }
}

// Initialize daily summary on page load
const userId = $(".start-time").first().data('user');
if (userId) {
    fetchDailySummary(userId);
}
 });//end  endtTime attendancd
