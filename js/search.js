$(document).ready(function () {
    console.log('Document ready'); // Log that the document is ready
    $('#eventSearch').on('input', function () {
        console.log('Input event triggered'); // Log that an input event is triggered

        var searchTerm = $(this).val().toLowerCase();

        // Loop through each event item and show/hide based on the search term
        $('.event-list li').each(function () {
            var eventText = $(this).text().toLowerCase();
            if (eventText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});