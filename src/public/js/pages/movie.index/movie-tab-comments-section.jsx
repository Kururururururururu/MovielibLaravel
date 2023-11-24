import { useRef, useState, useContext } from "react";
import { tabsType } from "./contants";
import { MovieComment } from "./movie-comment";
import { MovieCommentsSection } from "./movie-comments-section";
import { MovieTab } from "./movie-tab";
import { useMovieComments } from "./movie-comments-context"; // Import the MovieCommentsContext

export function MovieTabCommentsSection({ data, activeTab }) {
    const [comment, setComment] = useState("");
    const userName = document.getElementById("user-name").dataset.userName;
    const { addComment, optimisticComment } = useMovieComments();

    const commentInputRef = useRef(null);

    const handleCommentChange = (e) => setComment(e.target.value);

    const handleSubmit = async (e) => {
        e.preventDefault();

        if (comment.trim() === "") return;

        try {
            await addComment(comment);
            setComment("");
            commentInputRef.current.focus();
        } catch (error) {
            console.log(error);
        }
    };

    return (
        <MovieTab
            id={tabsType.COMMENTS}
            active={activeTab === tabsType.COMMENTS}
            title={"Comments"}
        >
            <form
                className="comment-form"
                onSubmit={handleSubmit}
                id="comment-form"
            >
                <label htmlFor="comment-input">
                    Commenting as <code>{userName}</code>
                </label>
                <textarea
                    ref={commentInputRef}
                    name="comment"
                    id="comment-input"
                    className="comment-form-textarea"
                    placeholder="Write a comment..."
                    value={comment}
                    onChange={handleCommentChange}
                ></textarea>
                <button
                    className="comment-form-btn"
                    type="submit"
                    id="comment-btn"
                    disabled={optimisticComment}
                >
                    {optimisticComment ? "Submitting..." : "Submit"}
                </button>
            </form>
            {optimisticComment && (
                <MovieComment
                    author={"You"}
                    content={optimisticComment}
                    optimistic={true}
                />
            )}
            <MovieCommentsSection
                active={activeTab === tabsType.COMMENTS}
                data={data}
            />
        </MovieTab>
    );
}
