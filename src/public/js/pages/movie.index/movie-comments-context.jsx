import React, { createContext, useState, useEffect, useContext } from "react";
import axios from "axios";

const MovieCommentsContext = createContext();

export const useMovieComments = () => useContext(MovieCommentsContext);

export function MovieCommentsProvider({ children, data }) {
    const [comments, setComments] = useState([]);
    const [isLoading, setIsLoading] = useState(true); // Added loading state
    const [optimisticComment, setOptimisticComment] = useState(null); // Added optimistic comment state

    const movieId = data.id;
    const userId = document.getElementById("user-id").dataset.userId;
    const userName = document.getElementById("user-name").dataset.userName;

    if (!movieId || !userId) {
        throw new Error("Movie or user ID not found");
    }

    const fetchComments = async () => {
        try {
            setIsLoading(true); // Set loading state to true before fetching comments
            const response = await axios.get(`/api/movie/${movieId}/comments`);
            if (response.data.status === "success") {
                const { comments } = response.data;
                // Sort comments by date
                comments.sort((a, b) => {
                    return new Date(b.updated_at) - new Date(a.updated_at);
                });
                setComments(comments);
            }
            setIsLoading(false); // Set loading state to false after fetching comments
        } catch (error) {
            console.error("Error fetching comments:", error);
            setIsLoading(false); // Set loading state to false in case of error
        }
    };

    const addComment = async (comment) => {
        try {
            setOptimisticComment(comment);
            const response = await axios.post(`/api/movie/${movieId}/comment`, {
                comment,
                userId,
            });
            if (response.data.status === "success") {
                const { comment: newComment } = response.data;
                setComments((prevComments) => [
                    {
                        ...newComment,
                        name: userName,
                    },
                    ...prevComments,
                ]);
                setOptimisticComment(null); // Remove the optimistic comment
            }
        } catch (error) {
            console.error("Error adding comment:", error);
            setOptimisticComment(null); // Remove the optimistic comment in case of error
        }
    };

    const removeComment = (commentId) => {
        setComments((prevComments) =>
            prevComments.filter((comment) => comment.id !== commentId)
        );
    };

    const updateComment = (updatedComment) => {
        setComments((prevComments) =>
            prevComments.map((comment) =>
                comment.id === updatedComment.id ? updatedComment : comment
            )
        );
    };

    // Expose the fetchComments function
    const exposedFunctions = {
        fetchComments,
        addComment,
        removeComment,
        updateComment,
        isLoading,
        optimisticComment,
    };

    return (
        <MovieCommentsContext.Provider
            value={{ comments, ...exposedFunctions }}
        >
            {children}
        </MovieCommentsContext.Provider>
    );
}
