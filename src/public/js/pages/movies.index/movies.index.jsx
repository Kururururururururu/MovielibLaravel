import React from "react";
import ReactDOM from "react-dom/client";

export default function MoviesIndex({ data }) {
    return (
        <section className="movie-list">
            {data.results.map((movie) => (
                <a
                    key={movie.id}
                    className="movie-link"
                    href={`/movie?id=${movie.id}`}
                >
                    <div className="movie-card">
                        <img
                            className="movie-image"
                            src={
                                movie.poster_path
                                    ? `https://image.tmdb.org/t/p/w200/${movie.poster_path}`
                                    : new URL(
                                          "../../../icons/movie_fallback_image.jpg",
                                          import.meta.url
                                      )
                            }
                        />
                        <h2 className="movie-text">{movie.title}</h2>
                        {/* Make either star or text based rating display here. 
                        Use own database instead of tmdb data. */}
                        <p className="movie-rating">{movie.vote_average}</p>
                        <p className="movie-release">{movie.release_date}</p>
                    </div>
                    <div className="page-select"></div>
                </a>
            ))}
        </section>
    );
}

if (document.getElementById("movies-index")) {
    const data = JSON.parse(
        document.getElementById("movies-index").getAttribute("data")
    );

    ReactDOM.createRoot(document.getElementById("movies-index")).render(
        <MoviesIndex data={data} />
    );
}
