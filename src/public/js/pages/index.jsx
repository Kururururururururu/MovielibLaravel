import React from "react";
import ReactDOM from "react-dom/client";

function FeaturedMovie({ href, imgSrc, alt, title, rating }) {
    return (
        <a className="featured" href={href}>
            <img className="movie-img" src={imgSrc} alt={alt} />
            <p className="movie-title">{title}</p>
            <p className="rating">{rating}</p>
        </a>
    );
}

export default function Index() {
    const featuredMovies = [
        {
            href: "#1",
            imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
            alt: "Movie 1",
            title: "title1",
            rating: 4,
        },
        {
            href: "#2",
            imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
            alt: "Movie 2",
            title: "title2",
            rating: 3,
        },
        {
            href: "#3",
            imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
            alt: "Movie 3",
            title: "title3",
            rating: 2,
        },
        {
            href: "#4",
            imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
            alt: "Movie 4",
            title: "title4",
            rating: 1,
        },
        {
            href: "#5",
            imgSrc: "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png?20200912122019",
            alt: "Movie 5",
            title: "title5",
            rating: 0,
        },
    ];

    return (
        <>
            <div className="welcome">
                <h1>Movie Rater</h1>
                <p>The Ultimate Film Appreciator</p>
                <div id="test"></div>
            </div>

            <div className="featured-movies">
                <h1>Featured movies:</h1>
                <div className="top5">
                    {featuredMovies.map((movie, index) => (
                        <FeaturedMovie
                            key={index}
                            href={movie.href}
                            imgSrc={movie.imgSrc}
                            alt={movie.alt}
                            title={movie.title}
                            rating={movie.rating}
                        />
                    ))}
                </div>
            </div>
        </>
    );
}

if (document.getElementById("index")) {
    const data = JSON.parse(
        document.getElementById("index").getAttribute("data")
    );
    ReactDOM.createRoot(document.getElementById("index")).render(
        <Index data={data} />
    );
}
