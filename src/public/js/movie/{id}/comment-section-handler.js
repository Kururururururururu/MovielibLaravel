const commentForm = document.getElementById('comment-form');
const commentInput = document.getElementById('comment-input');
const commentBtn = document.getElementById('comment-btn');

commentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    commentBtn.disabled = true;
    commentBtn.innerText = 'Submitting...';
    const movieId = new URLSearchParams(window.location.search).get('id');
    const comment = commentInput.value;
    fetch(`/api/movie/${movieId}/comment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ comment }),
    }).then((res) => res.json()).then((res) => {
        commentBtn.disabled = false;
        commentBtn.innerText = 'Submit';
        if (res.status === 'success') {
            commentInput.value = '';
            commentInput.focus();
        }
    }).catch((err) => {
        console.log(err);
    });
});
