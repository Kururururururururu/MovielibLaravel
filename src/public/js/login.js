document.addEventListener("DOMContentLoaded", function() {
    const registerbutton = document.getElementById("registerbutton");
    const loginbutton = document.getElementById("loginbutton");
    const username = document.getElementById("username");
    const password = document.getElementById("password");

    registerbutton.addEventListener("click", function(event) {
      event.preventDefault(); 

      window.location.href = "/register";

    });

    loginbutton.addEventListener("click", function(event) {
      if (!isValidUsername(username.value)) {
        event.preventDefault();
        return;
      }

      if (!isValidPassword(password.value)) {
        event.preventDefault();
        return;
      }

    });

    function isValidUsername(username) {
      if (username === '') {
        alert('Username is required.');
        return false;
      }
      return true;
    }

    function isValidPassword(password) {
      if (password === '') {
        alert('Password is required.');
        return false;
      }
      return true;
    }

});