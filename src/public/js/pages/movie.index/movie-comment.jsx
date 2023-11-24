export function MovieComment({
    author,
    content,
    updatedAt,
    optimistic = false,
}) {
    return (
        <div className={`comment ${optimistic ? "optimistic-comment" : ""}`}>
            <div className="comment-author">
                <span className="comment-author-name">{author}</span>
                <span className="comment-author-date">
                    {!optimistic && updatedAt}
                </span>
            </div>
            <div className="comment-content">{content}</div>
        </div>
    );
}
