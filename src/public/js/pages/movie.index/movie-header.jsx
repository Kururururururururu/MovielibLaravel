import { useState } from "react";

export function MovieHeader({ data }) {
    const [rating, setRating] = useState(data.rating);

    const renderStars = () => {
        const stars = [];
        const ratingFloor = Math.floor(rating);
        const ratingCeil = Math.ceil(rating);

        for (let i = 1; i <= 5; i++) {
            if (i <= ratingFloor) {
                stars.push(
                    <MovieStar
                        key={i}
                        starNumber={i}
                        setRating={setRating}
                        MovieStarType={MovieStarTypes.FULL}
                        idx={i}
                    />
                );
            } else if (i === ratingCeil && ratingCeil !== ratingFloor) {
                stars.push(
                    <MovieStar
                        key={i}
                        starNumber={i}
                        setRating={setRating}
                        MovieStarType={MovieStarTypes.HALF}
                        idx={i}
                    />
                );
            } else {
                stars.push(
                    <MovieStar
                        key={i}
                        starNumber={i}
                        setRating={setRating}
                        MovieStarType={MovieStarTypes.EMPTY}
                        idx={i}
                    />
                );
            }
        }

        return stars;
    };

    return (
        <div className="movie-header">
            <h1 className="movie-title">
                <a href={data.homepage} className="movie-title-link">
                    {data.title}
                </a>
            </h1>
            <div className="movie-rating" id="movie-rating-stars">
                {renderStars()}
            </div>
        </div>
    );
}

const MovieStarTypes = {
    FULL: {
        src: "/icons/star-filled.svg",
        alt: "full star",
    },
    HALF: {
        src: "/icons/star-half.svg",
        alt: "half star",
    },
    EMPTY: {
        src: "/icons/star-empty.svg",
        alt: "empty star",
    },
};

function MovieStar({ starNumber, setRating, MovieStarType, idx }) {
    const handleClick = () => {
        setRating(starNumber);
    };

    const [hovered, setHovered] = useState(false);

    const handleMouseEnter = () => {
        setHovered(true);
    };

    const handleMouseLeave = () => {
        setHovered(false);
    };

    return (
        <img
            src={hovered ? MovieStarTypes.FULL.src : MovieStarType.src}
            alt={MovieStarType.alt}
            className="star-icon"
            id={`star-${idx}`}
            onClick={handleClick}
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
        />
    );
}
