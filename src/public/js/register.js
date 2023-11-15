document.addEventListener("DOMContentLoaded", function() {
  const signinButton = document.getElementById("signinButton");
  const registerButton = document.getElementById("registerButton");
  const name = document.getElementById("name");
  const username = document.getElementById("username");
  const password = document.getElementById("password");
  const password_confirmation = document.getElementById("password_confirmation");
  const email = document.getElementById("email");

  signinButton.addEventListener("click", function(event) {
    event.preventDefault();
    window.location.href = "/login";
  });

  registerButton.addEventListener("click", function(event) {
    if (!isValidName(name.value)) {
      event.preventDefault();
      return;
    }

    if (!isValidUsername(username.value)) {
      event.preventDefault();
      return;
    }

    if (!isValidEmaill(email.value)) {
      event.preventDefault();
      return;
    }

    if (!isValidPassword(password.value, password_confirmation.value)) {
      event.preventDefault();
      return;
    }
  });

  // Check the validity of the name
  function isValidName(name) {
    if (!/^[a-zA-Z][a-zA-Z ]+$/.test(name)) {
      alert('Name must only contain letters.');
      return false;
    }

    if (name.length > 20) {
      alert('Name must be less than 20 characters.');
      return false;
    }

    return true;
  }

  // Check the validity of the username
  function isValidUsername(username) {
    if (username === '') {
      alert('Username is required.');
      return false;
    }
  
    if (username.length > 20) {
      alert('Username must be less than 20 characters.');
      return false;
    }
    if (!/^[a-zA-Z0-9][a-zA-Z0-9_-]*$/.test(username)) {
      alert('Username must start with a letter.');
      return false;
    }
  
    return true;
  }

  // Check the validity of the email
  function isValidEmaill(email) {
    if (email === '') {
      alert('Email is required.');
      return false;
    }

    var emailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailFormat.test(email)) {
      alert('Please enter a valid email address.');
      return false;
  }

    return true;
  }

  // Check the validity of the password
  function isValidPassword(password, password_confirmation) {
    if (password.length < 8) {
      alert('Password must be at least 8 characters.');
      return false;
    }

    if (!/[A-Z]/.test(password)) {
      alert('Password must contain at least one uppercase letter.');
      return false;
    }

    if (!/[a-z]/.test(password)) {
      alert('Password must contain at least one lowercase letter.');
      return false;
    }

    if (!/[0-9]/.test(password)) {
      alert('Password must contain at least one number.');
      return false;
    }

    if (!/[^A-Za-z0-9]/.test(password)) {
      alert('Password must contain at least one special character.');
      return false;
    }

    if (password === '' || password_confirmation === '') {
      alert('Password and password confirmation are required.');
      return false;
    }

    if (password !== password_confirmation) {
      alert('Password and password confirmation do not match.');
      return false;
    }

    return true;
  }
});