<?php

session_start();

require('Connexion_BD.php');

mysqli_set_charset($session, "utf-8");

require('decide-lang.php');
?>



<!DOCTYPE html>
<html>

<head>
  <title>Inscription</title>
  <meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
  <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
  <link href="Style_FAQ.css" type="text/css" rel="stylesheet" />
  <SCRIPT type="text/javascript">
    function validation() {
      var mdp = document.getElementById("motPasse").value;
      var mdp2 = document.getElementById("motPasse2").value;

      if (mdp == mdp2) {
        return (true);
      } else {
        alert("Les deux mots de passe ne sont pas identiques !");
        return false;
      }
    }
  </script>
</head>

<body>

  <?php
  require_once 'Connexion_BD.php';
  ?>

  <div class="header">
    <img alt="Logo UT1" class="img_logo" src="Bandeau.png">
  </div>

  <FORM action='reservation_portable' method="post">

    <DIV id="inscription">
      <H1>
        <CENTER><B> <?php echo TXT_ACCUEIL_INSCRIPTION;?> </B></CENTER>
      </H1>
      <HR>
      <CENTER>
        <TABLE NOBORDER>
          <TR>
            <TD align=right>
              <label for="nom"><?php echo TXT_NOM;?> : </label>
            </TD>
            <TD>
              <input type="text" id="nom" name="nom" autocomplete="off" size=50 required>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="prenom"><?php echo TXT_PRENOM;?> : </label>
            </TD>
            <TD>
              <input type="text" id="prenom" name="prenom" autocomplete="off" size=50 required>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="email"> <?php echo TXT_EMAIL;?> : </label>
            </TD>
            <TD>
              <input type="email" id="email" name="email" autocomplete="off" size=50 required>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="tel"> <?php echo TXT_TEL;?> : </label>
            </TD>
            <TD>
              <input type="text" id="tel" name="tel" autocomplete="off" size=50 required>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="statut"><?php echo TXT_IDENTITE;?> : </label>
            </TD>
            <TD>
              <SELECT id="statut" name="statut">
                <OPTION>Etudiant</OPTION>
                <OPTION>Enseignant</OPTION>
                <OPTION>Personnel Administratif</OPTION>
              </SELECT>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="formation"><?php echo TXT_FORMATION;?> : </label>
            </TD>
            <TD>
              <SELECT id="formation" name="formation">
                <OPTION>L3 MIASHS TI</OPTION>
                <OPTION>LICENCE PRO RTAI</OPTION>
                <OPTION>M1 MIAGE IM</OPTION>
                <OPTION>M1 MIAGE 2IS</OPTION>
                <OPTION>M1 MIAGE IDA</OPTION>
                <OPTION>M2 MIAGE IPM</OPTION>
                <OPTION>M2 MIAGE ISIAD</OPTION>
                <OPTION>M2 MIAGE 2IS</OPTION>
                <OPTION>M2 MIAGE IDA</OPTION>
                <OPTION>AUTRE</OPTION>
              </SELECT>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="motPasse"> <?php echo TXT_MDP_INS;?> : </label>
            </TD>
            <TD>
              <input type="password" id="motPasse" name="motPasse" size=50 required>
            </TD>
          </TR>
          <TR>
            <TD align=right>
              <label for="motPasse2"><?php echo TXT_CONFIRMER_MDP_INS;?> : </label>
            </TD>
            <TD>
              <input type="password" id="motPasse2" name="motPasse2" size=50 required>
            </TD>
          </TR>
        </TABLE>
      </CENTER><br>
    </DIV>
    <div class="legals_flex">
      <CENTER>
        <input  id="checkbox_newletter" name="checkbox_confidentiality_notice" required type="checkbox">
        <label class="checkbox_container"><?php echo TXT_CONFIDENTIEL;?></label><br>
        <input  id="checkbox_general_condition" name="checkbox_general_condition" required type="checkbox">
        <label class="checkbox_container"><?php echo TXT_CGU;?></label>
    </div>
    </center><br>
    <DIV id="Boutons">
      <center>
        <input type="submit" name="inscription" value="<?php echo TXT_ACCUEIL_INSCRIPTION;?>" onclick="return validation()">
        <input type="reset" value="<?php echo TXT_REINITIALISER;?>">
        <input type="button" value="<?php echo TXT_RETOUR;?>" onclick="history.go(-1)">
      </CENTER><br>
    </div>
  </FORM>
  </body>
</html>
