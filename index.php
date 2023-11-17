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

if (!empty($_SESSION["user"])) {
  echo '<pre>';
print_r($_SESSION["user"]);
echo '</pre>';
  echo "<p>Üdv {$_SESSION["user"]["username"]}</p>";
  if ($user["username"] = "admin") {
    header("admin.php");
  } else {
    header("profil.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <title>Sport</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
<?php
if(!isset($_SESSION["user"])) {
    echo "<div class='header'>
    <a href='#home'><h1 class='nav-title' id='logo'>Sportify</h1></a>
    <ul class='horizontal-nav'>
      <li><a href='#about'>About</a></li>
      <li><a href='#foci'>Football</a></li>
      <li><a href='#f1'>Formula 1</a></li>
      <li><a href='#tenisz'>Tennis</a></li>
      <li><a href='login.php'>Login</a></li>
      <li><a href='register.php'>Register</a></li>
      <li><a href='#'>Contact</a></li>
    </ul>
  </div>";
} elseif($_SESSION["user"]["role"] === "admin") {
  echo "<div class='header'>
    <a href='#home'><h1 class='nav-title' id='logo'>Sportify</h1></a>
    <ul class='horizontal-nav'>
    <li><a href='#about'>ADMIN</a></li>
      <li><a href='#about'>About</a></li>
      <li><a href='#foci'>Football</a></li>
      <li><a href='#f1'>Formula 1</a></li>
      <li><a href='#tenisz'>Tennis</a></li>
      <li><a href='#'>Contact</a></li>
      <li><a href='index.php?logout'>Logout</a></li>
    </ul>
  </div>";} else {
    echo "<div class='header'>
    <a href='#home'><h1 class='nav-title' id='logo'>Sportify</h1></a>
    <ul class='horizontal-nav'>
    <li><a href='#about'>FELHASZNÁLÓ</a></li>
      <li><a href='#about'>About</a></li>
      <li><a href='#foci'>Football</a></li>
      <li><a href='#f1'>Formula 1</a></li>
      <li><a href='#tenisz'>Tennis</a></li>
      <li><a href='#'>Contact</a></li>
      <li><a href='#'>Logout</a></li>
    </ul>
  </div>";}
?>
  

  <div class="section welcome" id="home">
    <h1>Welcome to <span class="title" id="sportify">Sportify</span>
  </div>


  <div class="section content about" id="about">
    <div class="content-wrapper" data-aos="fade-in">
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
  <?php
  //echo '<br>asd'; ?>
  <script src="loginscript.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>



</html>