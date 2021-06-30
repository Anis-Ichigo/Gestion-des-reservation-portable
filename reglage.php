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
  <link rel="stylesheet" href="connexion.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <div class="main">
    <div class="header">
      <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="width: 100%; margin-top: 1%">
    </div>
    <h2 align="center"> <?php echo TXT_ACCUEIL_REGLAGE; ?></h2>
    <form action="decide-lang.php" method="post">
      <p style="font-size: 1.5em"><?php echo CHOIX_LANGUE . ':'; ?></p>

      <div class="form-group" align="center" style="font-size: 1.25em">

        <input id="fr" type="radio" name="lang" value="fr" <?php
                                                            if($_SESSION['lang']=="fr"){
                                                                echo "checked";
                                                            }
                                                            ?>>
        <label for="fr">
          &nbsp;&nbsp;
          <span class="flag-icon flag-icon-fr"></span>
          Français
        </label>
        &nbsp;&nbsp;
        <input id="en" type="radio" name="lang" value="en" <?php
                                                            if($_SESSION['lang']=="en"){
                                                                echo "checked";
                                                            }
                                                            ?>>
        <label for="en">
          &nbsp; &nbsp;
          <span class="flag-icon flag-icon-um"></span>
          English
        </label><br><br>

        <input id="cn" type="radio" name="lang" value="cn"<?php
                                                            if($_SESSION['lang']=="cn"){
                                                                echo "checked";
                                                            }
                                                            ?>>
        <label for="cn">
          &nbsp; &nbsp;
          <span class="flag-icon flag-icon-cn"></span>
          简体中文
        </label><br><br>
          

        <input type="submit" name="enregistrer_parametres" value="<?php echo ENREGISTRER; ?>">

      </div>
    </form>
    &nbsp;&nbsp;
    <div class="text-center">
      <a href="menu3.php" type="button" class="btn btn-secondary"><?php echo TXT_MENU; ?></a>
    </div>

  </div>
</body>

</html>