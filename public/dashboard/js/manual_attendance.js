$(function () {
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
        var url = form.attr('action');
        var data = form.serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (data) {
                if (data.status == 'success') {
                    $('#manual_attendance_form')[0].reset();
                    $('#manual_attendance_table').DataTable().ajax.reload();
                    $('#manual_attendance_modal').modal('hide');
                    toastr.success(data.message);
                }
            },
           error: function (data) {
                toastr.error
           }
            
        });
    });
});//end class