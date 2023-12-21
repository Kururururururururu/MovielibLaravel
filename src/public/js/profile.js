
function toggleBan(userId) {

    $('.ban-button').prop('disabled', true);

    $.ajax({
        url: '/profile/user/' + userId + '/ban',
        type: 'PUT',
        data: {_token: $('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
            var button_color = data.is_banned ? 'green' : 'red';
            var text_color = data.is_banned ? 'red' : 'green';
            var rightsText = data.is_banned ? 'Cannot comment' : 'Can comment';
            var buttonText = data.is_banned ? 'Unban' : 'Ban';

            $('.ban-button').css('color', button_color).text(buttonText);
            $('.rights').css('color', text_color).text(rightsText);
            
            $('.ban-button').prop('disabled', false);
        }
    });
}
