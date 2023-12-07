$(document).ready(function () {
    $('.menu-option').click(function () {
        var action = $(this).data('action');
        $.get('load_content.php', { action: action }, function (data) {
            $('#content-container').html(data);
            
        });
    });
});
$(document).ready(function() {
    // Attach a click event handler to the management options
    $('.management-option').on('click', function(event) {
        event.preventDefault(); // Prevent the default behavior of the link

        // Get the data attributes
        var action = $(this).data('action');
        var userId = $(this).data('userid');
        var eventId = $(this).data('eventid');


        // Perform an AJAX request based on the action and userId
        $.ajax({
            url: 'ajax_handler.php', // Replace with the actual URL that handles the AJAX request
            type: 'POST',
            data: { action: action, userId: userId, eventId: eventId },
            success: function(response) {
                // Update the content container with the response
                $('#user-action-container').html(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});

$(document).ready(function() {
    // Attach a click event handler to the submit buttons
    $('#submitSet','#submitEvent').on('click', function() {
        // Get the form data from the modify form
       if ($(this).attr('id') === 'submitSet') {
            formData = $('#modifyForm').serializeArray();
            formData.push({ name: 'action', value: 'modify' });
        } else if ($(this).attr('id') === 'submitEvent') {
            formData = $('#eventForm').serializeArray();
            formData.push({ name: 'action', value: 'submitEvent' });
        }
        // Perform an AJAX request
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Check if the update was successful
                if (response.success) {
                    // Update the content container with the success message
                    $('#user-action-container').html('<p>' + response.message + '</p>');
                } else {
                    // Update the content container with the error message
                    $('#user-action-container').html('<p class="error">' + response.message + '</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});