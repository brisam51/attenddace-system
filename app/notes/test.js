$(function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Helper function for AJAX calls
    function handleAttendanceAction(url, button, projectId, userId, successCallback) {
        button.prop("disabled", true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: url,
            type: "POST",
            headers: { 'X-CSRF-TOKEN': token },
            data: { project_id: projectId, user_id: userId },
            success: function(response) {
                if (response.success) {
                    successCallback(response);
                } else {
                    showAlert('error', response.message);
                    resetButton(button);
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred while processing your request';
                
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                    }
                } else if (xhr.status === 0) {
                    errorMessage = 'Network error - please check your connection';
                }
                
                showAlert('error', errorMessage);
                resetButton(button);
            }
        });
    }

    function resetButton(button, originalText = null) {
        const text = originalText || button.data('original-text') || button.prop('defaultText');
        button.prop("disabled", false).html(text);
    }

    // Store original button text on elements
    $('.start-time, .end-time').each(function() {
        $(this).data('original-text', $(this).text());
    });

    // Start Time Handler
    $(".start-time").on("click", function() {
        const $button = $(this);
        handleAttendanceAction(
            "/attendance/start/time",
            $button,
            $button.data("id"),
            $button.data("user"),
            function(response) {
                showAlert("success", response.message);
                $(".start-time").hide();
                $(".end-time").show();
            }
        );
    });

    // End Time Handler
    $(".end-time").on("click", function() {
        const $button = $(this);
        handleAttendanceAction(
            "/attendance/end/time",
            $button,
            $button.data("id"),
            $button.data("user"),
            function(response) {
                showAlert("success", response.message);
                $(".end-time").hide();
                $(".start-time").show();
                // Optional: Update UI with time data if needed
                if (response.data) {
                    console.log('Worked:', response.data.total_minutes, 'minutes');
                }
            }
        );
    });

    // Alert function
    function showAlert(type, message) {
        const config = {
            icon: type,
            title: type.charAt(0).toUpperCase() + type.slice(1),
            text: message,
            showConfirmButton: false,
            timer: 2500
        };
        
        if (type === 'error') {
            config.icon = 'error';
            config.title = 'Error';
        }
        
        Swal.fire(config);
    }
});