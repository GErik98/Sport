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
  
</head>
<body>
<?php
if(!isset($_SESSION["user"])) {
  require('menus/basic_menu.php');;
} elseif($_SESSION["user"]["role"] === "admin") {
  require('menus/admin_menu.php');
} elseif($_SESSION["user"]["role"] === "szervezo") {
  require('menus/szervezo_menu.php');
} else {
  require('menus/user_menu.php');}
?>
  

  <div class="section welcome" id="home">
    <h1>Welcome to <span class="title" id="sportify">Sportify</span>
  </div>

  <div class="section about" id="about">
    <div class="content-wrapper">
      <h3>Our goals</h3>
      <h4>The goal of this website is to madafakapipip and the asdafasdasf so bas asd aseg esgesaged and exactly erum
        corrupti similique modi, impedit corporis iure natus adipisci id quod hic dicta
        facere illo, maxime placeat suscipit excepturi quas ipsum commodi. Sapiente molestias accusantium asperiores
        animi
        et aliquam similique quia suscipit delectus, no</h4>
    </div>
  </div>
  <div class="section content foci" id="foci">
    <div class="content-wrapper" data-aos="fade-in">
      <h3>Foci</h3>
      <h4>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ab cupiditate quidem blanditiis quam! Blanditiis
        odit,
        unde aspernatur molestiae rerum corrupti similique modi, impedit corporis iure natus adipisci id quod hic
        dicta
        facere illo, maxime placeat suscipit excepturi quas ipsum commodi. Sapiente molestias accusantium asperiores
        animi
        et aliquam similique quia suscipit delectus, nostrum in aut sint deleniti magni neque labore ipsum fuga rem
        autem
        molestiae consequatur commodi illum veniam. Non assumenda recusandae cumque obcaecati suscipit hic quas quis,
        ut
        temporibus provident cupiditate nihil dolorum eligendi molestias minima natus veritatis doloremque odit,
        praesentium nesciunt, ipsum soluta corporis laborum. Odit provident explicabo iure?
      </h4>
    </div>
  </div>
  <div class="section content f1" id="f1">
    <div class="content-wrapper" data-aos="fade-in">
      <h3>F1</h3>
      <h4>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut doloremque mollitia ab sit eum dolore. Nesciunt,
        perferendis? Ullam adipisci distinctio nemo assumenda quisquam, accusantium nam molestias consequatur, facilis
        hic
        perferendis dolores quod blanditiis nobis aspernatur doloribus aut in. Ut excepturi architecto, fuga dolore
        tenetur adipisci odit consectetur temporibus, illo accusamus nemo, blanditiis culpa provident? Officiis cum
        provident laborum, praesentium nesciunt rem dolorem rerum ullam architecto nihil exercitationem nam!
        Repudiandae
        harum molestias quis nisi ducimus aspernatur error tempore et. Nobis explicabo alias enim qui cupiditate
        deleniti?
        Cupiditate aliquid eos est soluta? Quos, maxime voluptatum molestiae maiores qui non pariatur suscipit ipsa.
      </h4>
    </div>
  </div>
  <div class="section content tenisz" id="tenisz">
    <div class="content-wrapper" data-aos="fade-in">
      <h3>Tenisz</h3>
      <h4>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque quasi ex ipsum explicabo quidem id, soluta,
        aspernatur temporibus architecto placeat quam ab voluptas cum amet eum, hic optio ducimus! Eveniet, aliquam
        minus.
        Dicta ipsa molestias harum enim. Aliquam cumque molestias temporibus saepe animi, illum assumenda quaerat
        magni
        reiciendis eveniet alias odio quam expedita, corrupti cum voluptate, porro soluta quasi! Sequi, sed soluta.
        Aperiam molestias dicta voluptate nisi nesciunt ullam optio officia harum blanditiis adipisci odit voluptates
        a
        pariatur reprehenderit fuga cupiditate, minima repellat deserunt nostrum. Odit architecto odio quibusdam totam
        quas eveniet unde, velit provident, ab dolores quidem expedita cum.
      </h4>
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

  <?php
  //echo '<br>asd'; ?>
  <!--<script src="loginscript.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

<!--<script src="animations.js"></script>-->

</html>