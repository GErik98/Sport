$(document).ready(function () {
    $('.menu-option').click(function () {
        var action = $(this).data('action');
        $.get('load_content.php', { action: action }, function (data) {
            $('#content-container').html(data);
            
        });
    });
});
