const initSlider = () => {
    const moviesList = document.querySelector(".carousel-wrapper .movieCarousel");
    const slideButtons = document.querySelectorAll(".carousel-wrapper .slide-button");
    const maxScroll = moviesList.scrollWidth;

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



    slideButtons.forEach(button => {
        button.addEventListener("click", () =>{
            const direction = button.id === "previous-slide" ? -1 : 1;
            console.log("Scroll width: " + maxScroll)
            if(moviesList.scrollLeft + moviesList.clientWidth == maxScroll && button.id === "next-slide"){
                console.log("End reached!")
                moviesList.scrollBy({left: -(moviesList.scrollLeft + moviesList.clientWidth), behavior: "smooth"});
            } else if(moviesList.scrollLeft == 0 && button.id === "previous-slide") {
                moviesList.scrollBy({left: maxScroll, behavior: "smooth"});
            } else {
                const scrollAmount = (moviesList.clientWidth)/1.20 * direction;
                moviesList.scrollBy({ left: scrollAmount, behavior: "smooth" });
            }
        });
    });
}

window.addEventListener("load", initSlider)