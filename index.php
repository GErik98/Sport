<?php
session_start();
$error = "";
$msg = "";
require_once("dbconnect.php");

if (isset($_GET["logout"])) {
  unset($_SESSION["user"]);
  unset($_SESSION["userId"]);
  setcookie("userId", "", time() - 1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <title>Sport</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="./js/scroll_navbar.js"></script>
  <script src="./js/hamburgermenu.js"></script>
</head>

<body>
  <?php
  if (!isset($_SESSION["user"])) {
    require('menus/basic_menu.php');
  } elseif ($_SESSION["user"]["role"] === "admin") {
    require('menus/admin_menu.php');
  } elseif ($_SESSION["user"]["role"] === "szervezo") {
    require('menus/szervezo_menu.php');
  } else {
    require('menus/user_menu.php');
  }
  ?>


  <div class="section welcome" id="home">
    <h1>Welcome to <span class="title" id="sportify">Sportify</span>
  </div>

  <div class="section about" id="about">
    <div class="content-wrapper">
      <h4>Our goals</h4>
      <p>At Sportify, we are dedicated to empowering sports enthusiasts and event organizers. Our mission is to provide a seamless platform that fosters community engagement, event creation, and participation in sporting activities. Here are our key goals:<br>
        <li style="list-style: none;">1. Facilitate Event Participation</li>
        <li style="list-style: none">2. Streamline Event Creation</li>
        <li style="list-style: none">3. Real-Time Event Updates</li>
        <li style="list-style: none">4. Foster a Thriving Sports Community</li>
      </p>

    </div>
  </div>
  <div class="section content event" id="event">
    <div class="content-wrapper" data-aos="fade-in">
      <?php include('merkozes.php'); ?>
    </div>
  </div>
  <div class="section content foci" id="foci">
    <div class="content-wrapper" data-aos="fade-in">
      <h4>Matchmaking</h4>
      <p>
        Discover the power of seamless matchmaking with Sportify! Our platform offers a unique and efficient way to connect with fellow sports enthusiasts, creating exciting opportunities for a variety of sports, including but not limited to:</p>
      <li><b>Football Matches</b></li>

      <p>Whether you're a striker with a killer instinct or a goalkeeper with lightning reflexes, Sportify enables you to find and join football matches that match your skill level and playing style.</p>

      <li><b>Basketball Showdowns</b></li>

      <p>Dribble, shoot, and slam dunk your way to victory! Sportify brings basketball enthusiasts together, making it easy to form teams or join existing matchups for a thrilling game on the court.</p>

      </p>
    </div>
  </div>
  <div class="section content f1" id="f1">
    <div class="content-wrapper" data-aos="fade-in">
      <h4>Racing Adventures</h4>
      <p>
        Rev up your engines and lace up your running shoes – Sportify is your ultimate destination for thrilling racing adventures! Unleash the speed demon within you and explore a variety of racing experiences, including:
      </p>
      <li><b>Track & Field Showdowns</b></li>
      <p>Feel the adrenaline rush on the track and field! Sportify brings together sprinters, jumpers, and throwers to compete in exciting competitions. Join or create events to showcase your speed, agility, and strength.</p>
      <li><b>Motorsport Meets</b></li>
      <p>For the petrolheads and racing enthusiasts, Sportify is your pit stop for motorsport meets. Connect with fellow racers, form racing teams, and compete in thrilling races, whether it's on the asphalt or off-road.</p>
    </div>
  </div>
  <div class="section content tenisz" id="tenisz">
    <div class="content-wrapper" data-aos="fade-in">
      <h4>Try it!</h4>
      <p>
        Create an account, or log in if you already have one, and join one of our races!
      </p>
      <div class="btn-container">
        <a href="login_register/login.php" class="button">Sign In</a>
        <a href="login_register/register.php" class="button">Sign Up</a>
      </div>
    </div>
  </div>
  <div class="section " id="contact">
    <div class="contact-wrapper" data-aos="fade-in">

      <!-- Contact Form -->
      <form action="process_contact.php" method="post">
        <h2>Contact Us</h2>
        <p>Feel free to reach out to us with any questions or feedback.</p>
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        <button type="submit" id="submitContact" name="submitContact" value="Submit">Submit</button>
      </form>
    </div>
  </div>
  <script>
    AOS.init();
  </script>

</body>

<!--<script src="animations.js"></script>-->

</html>