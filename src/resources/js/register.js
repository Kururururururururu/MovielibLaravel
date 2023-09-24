console.log("JavaScript file connected!");

document.addEventListener("DOMContentLoaded", function() {
    const signinButton = document.getElementById("signinButton");
  
    signinButton.addEventListener("click", function(event) {
      event.preventDefault(); // Prevent the form from submitting
  
      // Add your custom logic here for what should happen when the "Sign in" button is clicked
      // For example, you can redirect the user to the login page or show a login modal.
      // You can also remove this entire event listener if you don't need any special behavior.
    });
  });