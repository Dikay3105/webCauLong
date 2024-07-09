function displaySignMenu(input) {
  var backgroundLogin = document.getElementById("sigin-background");
    if (input == "Sign in" || input == "Sign up") {
      backgroundLogin.style.display = "flex";
    }
    else {
      backgroundLogin.style.display = "none";
      window.location.href = "index.php";
    }
  
  }
