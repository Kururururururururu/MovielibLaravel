import React, { useEffect, useRef, useState } from "react";
import ReactDOM from "react-dom/client";
import { MovieHeader } from "./movie-header.jsx";
import { MoviePoster } from "./movie-poster.jsx";
import { MovieInfoItem } from "./movie-info-item.jsx";
import { MoviePill } from "./movie-pill.jsx";
import { MovieWatchlistButton } from "./movie-watchlist-button.jsx";
import { MovieTab } from "./movie-tab.jsx";
import { MovieTabSection } from "./movie-tab-section.jsx";

const formatCurrency = (value) => {
    if (value > 1000000000) {
        return `$ ${Number((value / 1000000000).toFixed(2))} billion`;
    } else if (value > 1000000) {
        return `$ ${Number((value / 1000000).toFixed(2))} million`;
    } else if (value > 1000) {
        return `$ ${Number((value / 1000).toFixed(2))} thousand`;
    } else {
        return `$ ${Number(value.toFixed(2))}`;
    }
};

export default function MovieIndex({ data }) {
    return (
        <>
            <MovieHeader data={data} />
            <div className="movie-container">
                <MoviePoster data={data} />
                <div className="movie-info">
                    <MovieInfoItem title="Release Date:">
                        {data.release_date}
                    </MovieInfoItem>
                    <MovieInfoItem title="Runtime:">
                        {data.runtime} minutes
                    </MovieInfoItem>
                    <MovieInfoItem title="Genres:" asChild>
                        <div className="movie-info-item-genres">
                            {data.genres.map((genre, i) => (
                                <p className="movie-info-item-value" key={i}>
                                    {genre.name}
                                </p>
                            ))}
                        </div>
                    </MovieInfoItem>
                    <MovieInfoItem title="Reviews:">
                        {data.vote_count} reviews
                    </MovieInfoItem>
                    <MovieInfoItem title="Language(s):">
                        {data.spoken_languages.map((language, i) => (
                            <span key={i}>
                                {language.english_name}
                                {i !== data.spoken_languages.length - 1
                                    ? ", "
                                    : ""}
                            </span>
                        ))}
                    </MovieInfoItem>
                    <MovieInfoItem title="Adult:">
                        {data.adult ? (
                            <MoviePill>Yes</MoviePill>
                        ) : (
                            <MoviePill>No</MoviePill>
                        )}
                    </MovieInfoItem>
                    <MovieInfoItem title="Budget:">
                        <span>{formatCurrency(data.budget)}</span>
                    </MovieInfoItem>
                    <MovieInfoItem title="Revenue:">
                        <span>{formatCurrency(data.revenue)}</span>
                    </MovieInfoItem>
                    <MovieInfoItem title="Status:">{data.status}</MovieInfoItem>
                    <MovieInfoItem
                        title="Overview:"
                        className={"movie-info-item-overview"}
                    >
                        {data.overview}
                    </MovieInfoItem>
                    <MovieWatchlistButton data={data} />
                </div>
            </div>
            <hr className="divider" />
            <MovieTabSection data={data} />
        </>
    );
}

if (document.getElementById("movie-index")) {
    const data = JSON.parse(
        document.getElementById("movie-index").getAttribute("data")
    );
    ReactDOM.createRoot(document.getElementById("movie-index")).render(
        <MovieIndex data={data} />
    );
}
