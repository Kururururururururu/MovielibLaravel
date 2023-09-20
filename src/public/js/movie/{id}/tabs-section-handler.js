const commentTab = document.getElementById('comments_tab')
const moreInformationTab = document.getElementById('more_information_tab')
const commentTabBtn = document.getElementById('comment_btn')
const moreInformationTabBtn = document.getElementById('more_information_btn')
const commentsSection = document.getElementById('comments')

commentTabBtn.addEventListener('click', () => {

    commentTab.style.display = 'block'
    moreInformationTab.style.display = 'none'
    commentTabBtn.classList.add('active')
    moreInformationTabBtn.classList.remove('active')
    commentsSection.innerText = 'Loading...'
    const movieId = new URLSearchParams(window.location.search).get('id')
    fetch(`/api/movie/${movieId}/comments`, {
        cache: 'force-cache',
    }).then((res) => res.json()).then((res) => {
        commentsSection.innerText= ''
        if (res.status === 'success') {
            if (res.comments.length === 0) {
                commentsSection.innerText = 'No comments yet'
            } else {
                res.comments.forEach((comment) => {
                    const author = comment.author
                    const content = comment.comment
                    const updatedAt = new Date(comment.updated_at).toDateString()
                    const createdAt = new Date(comment.created_at).toDateString()

                    commentsSection.innerHTML += `
                    <div class="comment">
                        <div class="comment-author">
                            <span class="comment-author-name">${author}</span>
                            <span class="comment-author-date">${updatedAt}</span>
                        </div>
                        <div class="comment-content">
                            ${content}
                        </div>
                    </div>
                `
                })
            }
        }
    }).catch((err) => {
        console.log(err)
        commentsSection.innerText= ''
    })
})

moreInformationTabBtn.addEventListener('click', () => {

    commentTab.style.display = 'none'
    moreInformationTab.style.display = 'block'
    moreInformationTabBtn.classList.add('active')
    commentTabBtn.classList.remove('active')
})
