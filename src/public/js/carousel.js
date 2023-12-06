const initCarousel = () => {
    const moviesList = document.querySelector(".carousel-wrapper .movieCarousel");
    const slideButtons = document.querySelectorAll(".carousel-wrapper .slide-button");
    const nextButton = Array.from(slideButtons).find(button => button.id === "next-slide");

    const maxScroll = moviesList.scrollWidth;
    const scrollLength = 1.20;

    let autoScrollInterval;

    const restartAutoScroll = () => {
        clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(() => {
            console.log("Auto-Scrolling...")
            nextButton.click();
        }, 8000); // Auto-scroll every 8 seconds
    };

    moviesList.addEventListener("wheel", restartAutoScroll);
    moviesList.addEventListener("mouseover", () => clearInterval(autoScrollInterval));
    moviesList.addEventListener("mouseout", restartAutoScroll);

    slideButtons.forEach(button => {
        button.addEventListener("click", () =>{
            const direction = button.id === "previous-slide" ? -1 : 1;

            if(moviesList.scrollLeft + moviesList.clientWidth == maxScroll && button.id === "next-slide"){
                moviesList.scrollBy({left: -(moviesList.scrollLeft + moviesList.clientWidth), behavior: "smooth"});
            } else if(moviesList.scrollLeft == 0 && button.id === "previous-slide") {
                moviesList.scrollBy({left: maxScroll, behavior: "smooth"});
            } else {
                const scrollAmount = (moviesList.clientWidth)/scrollLength * direction;
                moviesList.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }

            restartAutoScroll();
        });
    });

    restartAutoScroll();
    /*moviesList.addEventListener("scroll", (event) => {
        moviesList.addEventListener("wheel", (event) => {

        console.log("Scroll width: " + maxScroll)
        let direction = event.deltaX;
        if(moviesList.scrollLeft + moviesList.clientWidth == maxScroll && direction == 1){
            console.log("End reached!")
            moviesList.scrollBy({left: -(moviesList.scrollLeft + moviesList.clientWidth), behavior: "smooth"});
        } else if(moviesList.scrollLeft == 0 && direction == -1) {
            moviesList.scrollBy({left: maxScroll, behavior: "smooth"});
        }
        })
    })*/
}

window.addEventListener("load", initCarousel)