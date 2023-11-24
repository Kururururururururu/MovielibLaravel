import React from "react";
import ReactDOM from "react-dom/client";

export default function MovieIndex({ data }) {
    console.log(data);
    const userId = document.getElementById("user-id").dataset.userId;
    return <div>{userId}</div>;
}

if (document.getElementById("movie-index")) {
    const data = JSON.parse(
        document.getElementById("movie-index").getAttribute("data")
    );
    ReactDOM.createRoot(document.getElementById("movie-index")).render(
        <MovieIndex data={data} />
    );
}
