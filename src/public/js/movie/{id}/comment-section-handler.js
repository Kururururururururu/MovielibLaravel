const commentForm = document.getElementById("comment-form");
const commentInput = document.getElementById("comment-input");
const commentBtn = document.getElementById("comment-btn");

commentForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const comment = commentInput.value;

    if (comment.trim() === "") return;
    commentBtn.disabled = true;
    commentBtn.innerText = "Submitting...";
    updateAddNewComment("You", comment, new Date().toDateString());
    const movieId = new URLSearchParams(window.location.search).get("id");
    fetch(`/api/movie/${movieId}/comment`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ comment, userId }),
    })
        .then((res) => res.json())
        .then((res) => {
            fetch(`/api/movie/${movieId}/comments`, {
                cache: "no-cache",
            })
                .then((res) => res.json())
                .then((res) => {
                    commentsSection.innerText = "";
                    if (res.status === "success") {
                        if (res.comments.length === 0) {
                            commentsSection.innerText = "No comments yet";
                        } else {
                            res.comments.forEach((comment) => {
                                const name = comment.name;
                                const content = comment.comment;
                                const user_id = comment.user_id;
                                const comment_id = comment.id;
                                const updatedAt = new Date(
                                    comment.updated_at
                                ).toDateString();
                                const createdAt = new Date(
                                    comment.created_at
                                ).toDateString();
                            
                                let deleteButtonHTML = ``;
                                console.log(comment_id);
                                if (window.page_visitor_isadmin) {
                                    deleteButtonHTML = `
                                        <button 
                                        class="comment-delete-btn"
                                        id="delete-btn-${comment_id}"
                                        onclick="delete_comment('${comment_id}')"
                                        >Delete Comment</button>
                                    `;
                                }

                                updateAddNewComment(
                                    deleteButtonHTML,
                                    user_id,
                                    name,
                                    content,
                                    updatedAt,
                                    false
                                );

                            });
                            commentBtn.disabled = false;
                            commentBtn.innerText = "Submit";
                            if (res.status === "success") {
                                commentInput.value = "";
                                commentInput.focus();
                            }
                        }
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        })
        .catch((err) => {
            console.log(err);
        });
});

function updateAddNewComment(deleteButtonHTML, user_id, author, content, updatedAt, optimistic = true) {
    const newComment = `
                    <div class="comment ${optimistic && "optimistic-comment"}">
                        <div class="comment-author">
                            <a href="/profile/${user_id}" class="comment-author-name">${author}</a>
                            <span class="comment-author-date">${updatedAt}</span>
                            ${deleteButtonHTML}
                        </div>
                        <div class="comment-content">
                            ${content}
                        </div>
                    </div>
                `;
    commentsSection.innerHTML = newComment + commentsSection.innerHTML;
}
