import React from "react";
import ReactDOM from "react-dom/client";

function SortByItem({ id, name, value, checked }) {
    return (
        <div className="sortby-item">
            <input
                type="radio"
                id={id}
                name="sortby"
                value={value}
                checked={checked}
            />
            <label htmlFor={id}>{name}</label>
        </div>
    );
}

const sortOptions = [
    {
        id: "sortby-vote-average",
        name: "Vote average",
        value: "vote_average",
        checked: true,
    },
    {
        id: "sortby-release-date",
        name: "Release date",
        value: "primary_release_date",
        checked: false,
    },
    {
        id: "sortby-popularity",
        name: "Popularity",
        value: "popularity",
        checked: false,
    },
];

export default function Menu({ data }) {
    return (
        <div className="menu">
            <pre> </pre>

            <div className="searchbar-box">
                <input type="text" placeholder="Search" className="searchbar" />
                <button className="searchbutton primary-button" id="">
                    <img
                        src={new URL("../../icons/search.svg", import.meta.url)}
                        alt="search"
                        className="icon"
                    />
                </button>
            </div>
            <pre> </pre>
            <div className="sort-by">
                <h1 className="text-2">Sort by</h1>
                <div className="sortby-list">
                    {sortOptions.map((option) => (
                        <SortByItem
                            key={option.id}
                            id={option.id}
                            name={option.name}
                            value={option.value}
                            checked={option.checked}
                        />
                    ))}
                </div>
            </div>
            <pre> </pre>
            <div className="tag">
                <h1 className="text-2">Genres</h1>
                <div className="tag-list">
                    {data.map((genre) => (
                        <div className="tag-item" key={genre.id}>
                            <input
                                type="checkbox"
                                id={genre.id}
                                name={genre.name}
                            />
                            <label htmlFor={genre.id}>{genre.name}</label>
                        </div>
                    ))}
                </div>
            </div>
            <pre> </pre>
            <button className="primary-button" id="">
                Apply
            </button>
        </div>
    );
}

if (document.getElementById("menu")) {
    const data = JSON.parse(
        document.getElementById("menu").getAttribute("data")
    );
    ReactDOM.createRoot(document.getElementById("menu")).render(
        <Menu data={data} />
    );
}
