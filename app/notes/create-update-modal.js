$(document).ready(function() {
    var modal = $('#addressModal');
    var form = $('#addressForm');
    var saveButton = $('#saveButton');

    // Open Modal for Creating or Editing Address
    $('#openCreateModal').click(function() {
        // Reset the form
        form.trigger('reset');
        $('.error-message').text('').hide();

        // Set the modal title and button text
        saveButton.text('Save Address');

        // Fetch existing address details for the user via AJAX
        $.ajax({
            url: '{{ route("get.address.details") }}',
            type: 'GET',
            data: {
                user_id: $('#user_id').val() // Assuming user_id is available in the form
            },
            success: function(response) {
                if (response.status === 'success' && response.data) {
                    // Populate the form fields with existing address data
                    $('#address_id').val(response.data.id); // Set address ID
                    $('#mobile').val(response.data.mobile);
                    $('#phone').val(response.data.phone);
                    $('#address').val(response.data.address);
                    $('#user_id').val(response.data.user_id);

                    // Set the modal title and button text
                    saveButton.text('Update Address');
                } else {
                    // No existing address found, prepare for creating a new one
                    $('#address_id').val(''); // Clear address ID
                    saveButton.text('Save Address');
                }

                // Show the modal
                modal.show();
            },
            error: function(xhr) {
                alert('Failed to fetch address details.');
            }
        });
    });

    // Handle Form Submission (Create or Update)
    form.on('submit',function(event) {
        event.preventDefault();

        // Determine the action (create or update)
        var addressId = $('#address_id').val();
        var url = addressId ? '{{ route("update.address") }}' : '{{ route("save.address") }}';
        var method = addressId ? 'PUT' : 'POST';

        // Collect data from the form
        var formData = {
            mobile: $('#mobile').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            user_id: $('#user_id').val(),
            address_id: addressId // Include address ID for updates
        };

        // Send data via AJAX
        $.ajax({
            url: url,
            type: method,
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    modal.hide(); // Hide the modal after saving
                    location.reload(); // Reload the page to reflect changes
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                if (response && response.status === 'error') {
                    // Display validation errors
                    if (response.errors) {
                        for (var field in response.errors) {
                            $('#' + field + '_error').text(response.errors[field][0]).show();
                        }
                    }
                } else {
                    alert('There was an error processing your request.');
                }
            }
        });
    });
});
