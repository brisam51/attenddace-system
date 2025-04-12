$(function () {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token
 // Get the current date in the user's local time zone
 
 // Set the initial value of the input field
 

    $("#work_date").persianDatepicker({
        format: "YYYY/MM/DD",
        initialValue: true,
        initialValueType: 'persian', // Ensure the initial value is in Persian
        observer: true, // Automatically update the input field
        timezone: 'Asia/Tehran' // Set the correct time zone
        
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
   //register new attendance 
    $("#manual_attendance_form").on('submit',function (e) {
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

//start update attendance
$("#edit_attendance_form").on('submit',function (e) {
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
        url: "/manual/attendance/update",
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: formData,
        dataType: "json",
        success: function (response) {
            if (response.success ===true) {
                $('#edit_attendance_form')[0].reset();
             showAlert('success',response.message);
           
            

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
  
  
  
});

//end updatet attendance
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