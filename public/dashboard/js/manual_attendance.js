$(function () {
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token

    $("#work_date").persianDatepicker({
        format: "YYYY/MM/DD",
      
        
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
            DefaultTime:false,
           showSeconds: false,
            showMeridian: true,
        },
        
    });
    //start AJAX 
    $("#manual_attendance_form").submit(function (e) {
        e.preventDefault();
       
      
        var form = $(this);
       
        var selectedUserIds=[];
      var  selectedUserIds=$('input[name="user_ids[]"]:checked').each(function() {
            selectedUserIds.push($(this).val());
        });
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
                if (response.success == true) {
                    $('#manual_attendance_form')[0].reset();
                   alert(data.message);
                    toastr.success(response.message);
                } else{ 
                    toastr.error(response.message);
                }
            },
            
           error: function (response) {
           if(response.success == false){
                toastr.error(response.message);
           }
                toastr.error
           }
            
        });
        console.log(formData);
    });
});//end class