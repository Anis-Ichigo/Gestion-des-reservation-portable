<?php
require('decide-lang.php');
require('Connexion_BD.php');
mysqli_set_charset($session, "utf-8");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Réglages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" href="styletest.css" type="text/css">
  <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
  <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="flag-icon-css-master/css/flag-icon.css" rel="stylesheet">
</head>

<body>
  <h1> <?php echo TXT_ACCUEIL_REGLAGE; ?></h1>
  <div class="main">
    <form action="decide-lang.php" method="post">
      <div class="form-group" align="center">
        <h3><?php echo CHOIX_LANGUE; ?></h3>
        <br>
        <input type="radio" name="lang" value="fr" checked>
        <label for="fr">
          &nbsp;&nbsp;
          <span class="flag-icon flag-icon-fr"></span>
          Français
        </label>
        &nbsp;&nbsp;
        <input type="radio" name="lang" value="en">
        <label for="en">
          &nbsp;&nbsp;
          <span class="flag-icon flag-icon-um"></span>
          English
        </label>
        <div>
          <br>
          <input type="submit" name="enregistrer_parametres" value="<?php echo ENREGISTRER; ?>">
        </div>
      </div>
    </form>
&nbsp;&nbsp;
    <div class="text-center">
      <a href="menu2.php" class="btn btn-secondary"><?php echo TXT_RETOUR;?></a>

    </div>

  </div>
</body>

</html>
