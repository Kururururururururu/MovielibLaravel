const initSlider = () => {
    const moviesList = document.querySelector(".carousel-wrapper .movieCarousel");
    const slideButtons = document.querySelectorAll(".carousel-wrapper .slide-button");

    slideButtons.forEach(button => {
        button.addEventListener("click", () =>{
            const direction = button.id === "previous-slide" ? -1 : 1;
            const scrollAmount = (moviesList.clientWidth)/3 * direction;
            moviesList.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });
    });
}

window.addEventListener("load", initSlider)