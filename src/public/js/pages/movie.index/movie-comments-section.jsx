import { useContext, useEffect, useState } from "react";
import { MovieComment } from "./movie-comment";
import { useMovieComments } from "./movie-comments-context";

export function MovieCommentsSection({ data, active }) {
    const {
        comments,
        fetchComments,
        addComment,
        refetchComments,
        removeComment,
        updateComment,
        isLoading,
    } = useMovieComments();

    useEffect(() => {
        fetchComments();
    }, [active]);

    return (
        <div id="comments">
            {isLoading ? (
                <p>Loading comments...</p> // Show loading message while fetching comments
            ) : comments.length === 0 ? (
                <p>No comments yet</p>
            ) : (
                comments.map((comment, index) => (
                    <MovieComment
                        key={index}
                        author={comment.name}
                        content={comment.comment}
                        updatedAt={comment.updated_at}
                    />
                ))
            )}
        </div>
    );
}
