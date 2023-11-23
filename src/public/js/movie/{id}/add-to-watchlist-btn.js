const addToWatchlistBtn = document.getElementById("add-to-watchlist-btn");

addToWatchlistBtn.addEventListener("click", () => {
    const isAdded =
        addToWatchlistBtn.attributes.getNamedItem("data-watchlist").value ===
        "true";
    const movieId = new URLSearchParams(window.location.search).get("id");
    addToWatchlistBtn.disabled = true;

    if (isAdded) {
        addToWatchlistBtn.innerText = "Removing from Watchlist...";
        removeFromWatchlist(movieId);
        addToWatchlistBtn.attributes.getNamedItem("data-watchlist").value =
            "false";
    } else {
        addToWatchlistBtn.innerText = "Adding to Watchlist...";
        addToWatchlist(movieId);
        addToWatchlistBtn.attributes.getNamedItem("data-watchlist").value =
            "true";
    }
});

function addToWatchlist(id) {
    fetch(`/api/movie/${id}/watchlist`, {
        method: "POST",
        body: JSON.stringify({ userId }),
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((res) => res.json())
        .then((res) => {
            if (res.status === "success") {
                addToWatchlistBtn.innerText = "Added to Watchlist";
                addToWatchlistBtn.disabled = true;
                addToWatchlistBtn.classList.add("added");
            }

            setTimeout(() => {
                addToWatchlistBtn.innerText = "Remove from Watchlist";
                addToWatchlistBtn.disabled = false;
                addToWatchlistBtn.classList.remove("added");
            }, 3000);
            console.log(res);
        })
        .catch((err) => {
            addToWatchlistBtn.innerText = "Add to Watchlist";
            addToWatchlistBtn.disabled = false;
            console.error(err);
        });
}

function removeFromWatchlist(id) {
    fetch(`/api/movie/${id}/watchlist`, {
        method: "DELETE",
        body: JSON.stringify({ userId }),
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((res) => res.json())
        .then((res) => {
            if (res.status === "success") {
                addToWatchlistBtn.innerText = "Removed from Watchlist";
                addToWatchlistBtn.disabled = true;
                addToWatchlistBtn.classList.add("removed");
            }

            setTimeout(() => {
                addToWatchlistBtn.innerText = "Add to Watchlist";
                addToWatchlistBtn.disabled = false;
                addToWatchlistBtn.classList.remove("removed");
            }, 3000);
            console.log(res);
        })
        .catch((err) => {
            addToWatchlistBtn.innerText = "Remove from Watchlist";
            addToWatchlistBtn.disabled = false;
            console.error(err);
        });
}
