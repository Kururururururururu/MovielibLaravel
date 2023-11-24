import { useState, useRef } from "react";
import axios from "axios";

/**
 * @param {"post"|"delete"} method
 * @returns
 */
const handleWatchlistAction = async (method) => {
    const movieId = new URLSearchParams(window.location.search).get("id");
    const userId = document.getElementById("user-id").dataset.userId;

    try {
        const response = await axios({
            method,
            url: `/api/movie/${movieId}/watchlist`,
            data: { userId },
        });
        return response.data;
    } catch (error) {
        throw error;
    }
};

export function MovieWatchlistButton({ data }) {
    const watchlistStatusRef = useRef(data.watchlist);
    const getBtnMessage = () =>
        watchlistStatusRef.current
            ? "Remove from Watchlist"
            : "Add to Watchlist";
    const [isLoading, setIsLoading] = useState(false);
    const [message, setMessage] = useState(getBtnMessage());

    const addToWatchlist = async () => {
        return handleWatchlistAction("post");
    };

    const removeFromWatchlist = async () => {
        return handleWatchlistAction("delete");
    };

    const handleWatchlistClick = async () => {
        setIsLoading(true);
        try {
            if (watchlistStatusRef.current) {
                setMessage("Removing from Watchlist...");
                await removeFromWatchlist();
                watchlistStatusRef.current = false;
                setMessage("Removed from Watchlist");
            } else {
                setMessage("Adding to Watchlist...");
                await addToWatchlist();
                watchlistStatusRef.current = true;
                setMessage("Added to Watchlist");
            }
            setTimeout(() => {
                setIsLoading(false);
                setMessage(getBtnMessage());
            }, 3000);
        } catch (error) {
            setMessage("Error occurred");
            console.error(error);
            setIsLoading(false);
        }
    };

    return (
        <button
            className={`movie-watchlist-btn ${
                watchlistStatusRef.current && !isLoading
                    ? "removed"
                    : watchlistStatusRef.current && isLoading
                    ? "removed"
                    : !watchlistStatusRef.current && isLoading
                    ? "added"
                    : ""
            }`}
            id="add-to-watchlist-btn"
            data-watchlist={watchlistStatusRef.current ? "true" : "false"}
            onClick={handleWatchlistClick}
            disabled={isLoading}
        >
            <span>{message}</span>
        </button>
    );
}
