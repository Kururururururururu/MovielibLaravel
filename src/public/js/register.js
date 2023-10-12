console.log("Virker lortet?");

document.addEventListener("DOMContentLoaded", function() {
    const signinButton = document.getElementById("signinButton");
  
    signinButton.addEventListener("click", function(event) {
      event.preventDefault(); 

      window.location.href = "/login";

    });

    const registerButton = document.getElementById("registerButton");

    registerButton.addEventListener("click", function(event) {
        event.preventDefault();

        window.location.href = "/index";
    });
  });