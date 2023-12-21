const commentTab = document.getElementById("comments_tab");
const moreInformationTab = document.getElementById("more_information_tab");
const commentTabBtn = document.getElementById("comment_btn");
const moreInformationTabBtn = document.getElementById("more_information_btn");
const commentsSection = document.getElementById("comments");

commentTabBtn.addEventListener("click", () => {
    commentTab.style.display = "block";
    moreInformationTab.style.display = "none";
    commentTabBtn.classList.add("active");
    moreInformationTabBtn.classList.remove("active");
    commentsSection.innerText = "Loading...";
    const movieId = new URLSearchParams(window.location.search).get("id");
    fetch(`/api/movie/${movieId}/comments`, {
        cache: "no-cache",
    })
        .then((res) => res.json())
        .then((res) => {
            console.log(res);
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
                        
                        commentsSection.innerHTML += `
                    <div class="comment">
                        <div class="comment-author">
                            <a href="/profile/${user_id}" class="comment-author-name">${name}</a>
                            <span class="comment-author-date">${updatedAt}</span>
                            ${deleteButtonHTML}
                        </div>
                        <div class="comment-content">
                            ${content}
                        </div>
                    </div>
                    `;
                    });
                }
            }
        })
        .catch((err) => {
            console.error(err);
            commentsSection.innerText = "";
        });
});

moreInformationTabBtn.addEventListener("click", () => {
    commentTab.style.display = "none";
    moreInformationTab.style.display = "block";
    moreInformationTabBtn.classList.add("active");
    commentTabBtn.classList.remove("active");
});
