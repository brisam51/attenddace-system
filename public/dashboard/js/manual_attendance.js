$(function () {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token

    $("#work_date").persianDatepicker({
        format: "YYYY/MM/DD",
        initialValue: false ,// Ensures it respects the input's value
        onShow: function() {
            // Correct the date by subtracting 1 day if needed
            var correctDate = new persianDate().startOf('day').subtract('days', 1);
            $("#work_date").val(correctDate.format('YYYY/MM/DD'));
        }
        
    });

    $("#start_time").persianDatepicker({
        format: "HH:mm",
        initialValue: false,
        onlyTimePicker: true,
        timePicker: {
            observe:true,
            defaultTime: false, 
            enabled:true,
            showSeconds: false,
            showMeridian: true,
        },
        
    });
    $("#end_time").persianDatepicker({
        format: "HH:mm",
        initialValue: false,
        onlyTimePicker: true,
        timePicker: {
           // enabled:true,
            defaultTime:false,
           showSeconds: false,
            showMeridian: true,
        },
        
    });
    //start AJAX 
    $("#manual_attendance_form").submit(function (e) {
        e.preventDefault();
       
      try {
        var form = $(this);
       
        var selectedUserIds=[];
      var  selectedUserIds=$('input[name="user_ids[]"]:checked').map(function(){
            return $(this).val();
      }).get();
        var formData = {
            'start_time':$("#start_time").val(),
            'end_time': $("#end_time").val(),
            'work_date': $("#work_date").val(),
            'project_id': $("#project_id").val(),
            'user_ids': selectedUserIds,
           
        }; 
      
        if (selectedUserIds.length === 0) {
            alert('Please select at least one user');
            return;
        }
      
       
        
        $.ajax({
            type: "POST",
            url: "/manual/attendance/store",
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success ===true) {
                    $('#manual_attendance_form')[0].reset();
                 showAlert('success',response.message);
                   // toastr.success(response.message);
                } else{
                    showAlert('error',response.message); 
                    //toastr.error(response.message);
                }
            },
            
           error: function (xhr) {
           var ErrorMessage=xhr.responseJSON?xhr.responseJSON.message:'Something went wrong';
                //toastr.error(ErrorMessage);
                showAlert('error',ErrorMessage);
           }
            
        });
      }catch(error){
       //toastr.error('Error:',error.message);
       showAlert('error',error.message);
      }
      
      
      
    });//end form submit

    function showAlert(icon, message,timer=3500) {
        const config = {
             icon: icon,
             text: message,
             timer: timer,
             toast: true,
             position: "top",
             showConfirmButton: true,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
             }
 
        }
        
        Swal.fire(config);
       
     }//end of alert function
});//end class