<?php
require('decide-lang.php');
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>CodePen - Mobile Menu</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="Untitled-1.css" />
  <script type="text/javascript" src="menu2js.js"></script>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="main">

    <div class="menu">
      <a href="reservation_portable.php">
        <div class="menu__item" id="0-0"> <img class="menu__icon" src="signe-plus-dans-un-cercle-noir.svg" />
          <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </a>
    </div>
    <a href="mes_reservations.php">
      <div class="menu__item" id="1-0"><img class="menu__icon" src="livre.svg" />
        <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </div>
    </a>
    <a href="profil.php">
      <div class="menu__item" id="0-1"><img class="menu__icon" src="forme-de-l'utilisateur.svg" />
        <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </div>
    </a>
    <a href="FAQ.php">
      <div class="menu__item" id="1-1"><img class="menu__icon" src="signe-de-question.svg" />
        <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </div>
    </a>
    <a href="reglage.php">
      <div class="menu__item" id="0-2"><img class="menu__icon" src="silhouette-de-roue-dentee.svg" />
        <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </div>
    </a>
    <a href="deconnexion.php">
      <div class="menu__item" id="1-2"><img class="menu__icon" src="option-de-deconnexion.svg" />
        <div class="menu__content"><span class="menu__span"></span><span class="menu__span"></span></div>
      </div>
    </a>

  </div>
  </div>
  <!-- partial -->
  <script src="./script.js"></script>

</body>

</html>
