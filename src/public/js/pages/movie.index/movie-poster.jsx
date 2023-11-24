export function MoviePoster({ data }) {
    return (
        <figure className="movie-poster-container">
            <img
                src={`https://image.tmdb.org/t/p/original${data.backdrop_path}`}
                alt={data.title}
                loading="lazy"
                className="movie-poster"
            />
            <figcaption className="movie-poster-caption">
                {data.tagline}
            </figcaption>
        </figure>
    );
}
