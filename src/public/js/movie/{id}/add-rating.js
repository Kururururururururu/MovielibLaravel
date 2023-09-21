const stars = document.getElementsByClassName("star-icon")
const ratingDiv = document.getElementById("movie-rating-stars")
const movieId = new URLSearchParams(window.location.search).get('id')

ratingDiv.addEventListener('mouseover', (e) => {
    for (const star of stars) {
        star.classList.add('hover-not-selected')
    }
})

for (let i = 0; i < stars.length; i++) {
    stars[i].addEventListener('mouseover', () => {
        for (let j = 0; j <= i; j++) {
            stars[j].classList.add('hover-selected')
            stars[j].classList.remove('hover-not-selected')
        }
    })

    stars[i].addEventListener('mouseout', () => {
        for (let j = 0; j <= i; j++) {
            stars[j].classList.remove('hover-selected')
            stars[j].classList.remove('hover-not-selected')
        }
    })
}

ratingDiv.addEventListener('mouseout', (e) => {
    for (const star of stars) {
        star.classList.remove('hover-not-selected')
        star.classList.remove('hover-selected')
    }
})

for (let i = 0; i < stars.length; i++) {
    stars[i].addEventListener('click', () => {
        const rating = i + 1

        fetch(`/api/movie/${movieId}/rating`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({rating})
        }).then((res) => res.json()).then((res) => {
            console.log(res)
        }).catch((err) => {
            console.error(err)
        })
    })
}
