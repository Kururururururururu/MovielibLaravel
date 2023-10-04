document.addEventListener("DOMContentLoaded", function() {
    const registerbutton = document.getElementById("registerbutton");
  
    registerbutton.addEventListener("click", function(event) {
      event.preventDefault(); 

      window.location.href = "/register";

    });
 });