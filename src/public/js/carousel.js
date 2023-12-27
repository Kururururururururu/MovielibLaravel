/**
 * MovieCarousel class for creating a movie carousel.
 *
 * This class represents a movie carousel that can display a list of movies.
 *
 * @class
 * @param {HTMLElement} container - The HTML container element for the carousel.
 * @param {Array} movies - The array of movies to display in the carousel. Each movie in the array should include: id, poster_path, title, and vote_average.
 * @param {Number} [autoScroll=0] - Determines how often the carousel will autoscroll in seconds. Set to 0 to disable autoscrolling.
*/

class MovieCarousel {   // MovieCarousel class for creating a movie carousel
    constructor(container, movies, autoScroll = 0) { 
        this.container = container;
        this.movies = movies;
        this.autoScroll = autoScroll;
        this.initialize();
    }

    generateMovieCard(movie) {
        // Takes in a movie as a parameter and generates the HTML for it.
        return `
            <a class="featured" href="/movie?id=${movie.id}">
                <img class="movie-img" src="${movie.poster_path ?
                    `https://image.tmdb.org/t/p/w200/${movie.poster_path}` :
                    'icons/movie_fallback_image.jpg'}">
                <div class="featured-textbox">
                    <p class="movie-title">${movie.title}</p>
                    <p class="rating">${movie.vote_average}</p>
                </div>
            </a>
        `;
    }

    initialize() {
        /* GENERATE CAROUSEL */
        // Adding the stylesheet link for the carousel css
        const stylesheetLink = document.createElement('link');
        stylesheetLink.rel = 'stylesheet';
        stylesheetLink.href = 'css/carousel.css'; // Adjust the path if needed
        document.head.appendChild(stylesheetLink);

        // Create the carousel wrapper
        const carouselWrapper = document.createElement('div');
        carouselWrapper.className = 'carousel-wrapper';

        // Create the movie carousel container
        const movieCarousel = document.createElement('div');
        movieCarousel.className = 'movieCarousel';

        // Generate the html for every movie in the parsed list of movies and append the HTML to the movie carousel container.
        this.movies.forEach(movie => {
            movieCarousel.innerHTML += this.generateMovieCard(movie);
        });
        
        // Appends the movie carousel container to the carousel wrapper
        carouselWrapper.appendChild(movieCarousel);

        // Creates the previous button and adds the id, class name, and text content
        const previousButton = document.createElement('button');
        previousButton.id = 'previous-slide';
        previousButton.className = 'slide-button material-symbols-rounded';
        previousButton.textContent = 'chevron_left';

        // Creates the next button and adds the id, class name, and text content
        const nextButton = document.createElement('button');
        nextButton.id = 'next-slide';
        nextButton.className = 'slide-button material-symbols-rounded';
        nextButton.textContent = 'chevron_right';

        // Appends the buttons to the carousel wrapper.
        carouselWrapper.appendChild(previousButton);
        carouselWrapper.appendChild(nextButton);

        // Appends the full carousel to the chosen container.
        this.container.appendChild(carouselWrapper);

        /* EVENT LISTENERS */
        // Add on click event listeners for the movie carousel buttons.
        this.addEventListeners(movieCarousel, [previousButton, nextButton]);

        // Adds event listeners for the auto-scroll, restarting or stopping upon user interaction.
        this.container.addEventListener("wheel", () => this.restartAutoScroll());
        this.container.addEventListener("mouseover", () => this.stopAutoScroll());
        this.container.addEventListener("mouseout", () => this.restartAutoScroll());

        // Starts the auto-scroll
        this.restartAutoScroll();
    }

    addEventListeners(movieCarousel, buttons) {   // Adds event listeners for the movie carousel buttons
        const maxScroll = movieCarousel.scrollWidth;

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const direction = button.id === 'previous-slide' ? -1 : 1;  // -1 for previous, else next
                const currentScroll = movieCarousel.scrollLeft + movieCarousel.clientWidth;     // Current scroll position + width of the carousel
                if (    // If the carousel is at the end or beginning, scroll to the opposite end
                    (currentScroll === maxScroll && button.id === 'next-slide') ||
                    (movieCarousel.scrollLeft === 0 && button.id === 'previous-slide')
                ) { 
                    const scrollAmount = button.id === 'next-slide' ? -(currentScroll) : maxScroll;
                    movieCarousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                } else {    // Else scroll by 120% of the carousel width
                    const scrollAmount = (movieCarousel.clientWidth / 1.20) * direction;
                    movieCarousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            });
        });
    }

    restartAutoScroll() {
        if(this.autoScroll > 0 ) {     // If 0, auto-scrolling is disabled
            this.autoScrollInterval = setInterval(() => {   // Set an interval to auto-scroll
                const movieCarousel = this.container.querySelector('.movieCarousel');   // Get the movie carousel
                const nextButton = this.container.querySelector('#next-slide'); // Get the next button
                nextButton.click();    // Simulate a click on the next button
            }, this.autoScroll * 1000); // Auto-scroll every x seconds
        }
    }

    stopAutoScroll() {
        clearInterval(this.autoScrollInterval);
    }

    /* API */
    // API method to add movies to the carousel
    addMovies(newMovies) {
        this.movies = [...this.movies, ...newMovies];
        const movieCarousel = this.container.querySelector('.movieCarousel');
        newMovies.forEach(movie => {
            movieCarousel.innerHTML += this.generateMovieHTML(movie);
        });
    }

    // API method to remove movies from the carousel
    removeMovies(movieIds) {
        this.movies = this.movies.filter(movie => !movieIds.includes(movie.id));
        const movieCarousel = this.container.querySelector('.movieCarousel');
        movieIds.forEach(movieId => {
            const movieElement = movieCarousel.querySelector(`[href="/movie?id=${movieId}"]`);
            if (movieElement) {
                movieElement.remove();
            }
        });
    }

    // API method to set the auto-scroll time in seconds
    setAutoScrollTime(timeInSeconds) {
        this.autoScroll = timeInSeconds;
        this.restartAutoScroll();
    }
}
