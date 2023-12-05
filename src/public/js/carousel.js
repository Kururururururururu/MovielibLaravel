const moviesData = [
  /* ... Movie data here ... */
];

// Constants
const carouselContainer = document.querySelector('.top5');
const carouselItems = document.querySelectorAll('.top5 .featured');
const totalMovies = moviesData.length;
let currentIndex = 0;

// Function to update carousel display
function updateCarousel() {
  carouselItems.forEach((item, index) => {
    const movieIndex = (currentIndex + index) % totalMovies;
    const movie = moviesData[movieIndex];

    // Update the content of each carousel item
    // Modify this part according to movie data structure
    const imgSrc = `https://image.tmdb.org/t/p/w200/${movie.poster_path}`;
    const title = movie.title;
    const rating = movie.vote_average;

    // Update the carousel item content
    item.innerHTML = `
      <a class="featured" href="/movie?id=${movie.id}">
        <img class="movie-img" src="${imgSrc}">
        <div class="featured-textbox">
          <p class="movie-title">${title}</p>
          <p class="rating">${rating}</p>
        </div>
      </a>
    `;
  });
}

// Function to handle automatic carousel scrolling
function autoScroll() {
  currentIndex = (currentIndex + 1) % totalMovies;
  updateCarousel();
}

// Set up automatic scrolling
setInterval(autoScroll, 2000); // Change the interval as needed

// TODO: Add event listeners for manual control (left and right arrows)
