function hamburgermenu() {
  var x = document.getElementById("myNavbar");
  if (x.className === "header") {
    x.className += " responsive";
  } else {
    x.className = "header";
  }
}