document.addEventListener("DOMContentLoaded", function() {
  const signinButton = document.getElementById("signinButton");

  signinButton.addEventListener("click", function(event) {
    event.preventDefault();
    window.location.href = "/login";
  });

});