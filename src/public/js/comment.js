document.addEventListener("DOMContentLoaded", function() {
    const commentButton = document.getElementById("comment-btn");
    const comment = document.getElementById("comment-input");



    commentButton.addEventListener("click", function(event) {
        if (!isValidComment(comment.value)) {
            event.preventDefault();
            return;
        }
    });

    function isValidComment(comment) {
        if (comment === '') {
            alert('Comment is required.');
            return false;
        }
        if (!/^[A-Za-z0-9]+$/.test(comment)) {
            alert('Comment must only contain letters and numbers.');
            return false;
        }
        if (comment.length > 250) {
            alert('Comment must be less than 250 characters.');
            return false;
        }
        if (comment.length < 5) {
            alert('Comment must be at least 5 character.');
            return false;
        }
        return true;
    }

});

