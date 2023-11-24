import axios from "axios";
const commentForm = document.getElementById("comment-form");
const commentInput = document.getElementById("comment-input");
const commentBtn = document.getElementById("comment-btn");

commentForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const comment = commentInput.value;

    if (comment.trim() === "") return;
    commentBtn.disabled = true;
    commentBtn.innerText = "Submitting...";
    updateAddNewComment("You", comment, new Date().toDateString());
    const movieId = new URLSearchParams(window.location.search).get("id");

    try {
        const newCommentRes = await axios.post(
            `/api/movie/${movieId}/comment`,
            { comment, userId }
        );

        if (newCommentRes.data.status === "success") {
            commentBtn.disabled = false;
            commentBtn.innerText = "Submit";
            commentInput.value = "";
            commentInput.focus();
        } else {
            updateAddNewComment(
                "You",
                comment,
                new Date().toDateString(),
                false
            );
            commentBtn.disabled = false;
            commentBtn.innerText = "Submit";
            commentInput.value = "";
            commentInput.focus();
        }

        const res = await axios.get(`/api/movie/${movieId}/comments`, {
            cache: "no-cache",
        });

        commentsSection.innerText = "";
        if (res.data.status === "success") {
            if (res.data.comments.length === 0) {
                commentsSection.innerText = "No comments yet";
            } else {
                res.data.comments.forEach((comment) => {
                    const name = comment.name;
                    const content = comment.comment;
                    const updatedAt = new Date(
                        comment.updated_at
                    ).toDateString();
                    const createdAt = new Date(
                        comment.created_at
                    ).toDateString();
                    updateAddNewComment(name, content, updatedAt, false);
                });
                commentBtn.disabled = false;
                commentBtn.innerText = "Submit";
                if (res.data.status === "success") {
                    commentInput.value = "";
                    commentInput.focus();
                }
            }
        }
    } catch (err) {
        console.log(err);
    }
});

function updateAddNewComment(author, content, updatedAt, optimistic = true) {
    const newComment = `
                    <div class="comment ${optimistic && "optimistic-comment"}">
                        <div class="comment-author">
                            <span class="comment-author-name">${author}</span>
                            <span class="comment-author-date">${updatedAt}</span>
                        </div>
                        <div class="comment-content">
                            ${content}
                        </div>
                    </div>
                `;
    commentsSection.innerHTML = newComment + commentsSection.innerHTML;
}
