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


        // Perform an AJAX request based on the action and userId
        $.ajax({
            url: 'ajax_handler.php', // Replace with the actual URL that handles the AJAX request
            type: 'POST',
            data: { action: action, userId: userId },
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
    // Attach a click event handler to the submit button
    $('#submitSet').on('click', function() {
        // Get the form data
        var formData = $('#modifyForm').serializeArray();

        // Add the action to the form data
        formData.push({ name: 'action', value: 'modify' });

        // Perform an AJAX request
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            data: formData,
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