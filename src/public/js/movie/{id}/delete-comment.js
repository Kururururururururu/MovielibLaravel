function delete_comment(comment_id = null) {
    
    if (comment_id == null) {
        console.log('Something went wrong... The comment_id didn\'t get to the delete-comment.js file.');
        return;
    }

    console.log('i am in the delete_comment function, and a am getting this id: ' + comment_id);

    $(`#delete-btn-${comment_id}`).prop('disabled', true).text('Deleting...');

    $.ajax({
        url: '/comments/' + comment_id,
        type: 'DELETE',
        data: {_token: $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            if (response.success) {
                console.log('The comment was successfully deleted');
                $(`#delete-btn-${comment_id}`).text('Deleted').css('background-color', 'darkgray');
            } else {
                console.log('No comment was found with the given id');
                $(`#delete-btn-${comment_id}`).text('couldn\'t delete').css('background-color', 'lightgray');
            }
            
        }
    });

}