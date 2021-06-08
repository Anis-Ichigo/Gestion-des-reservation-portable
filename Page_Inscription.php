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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <SCRIPT type="text/javascript">
    function validation() {

      var mdp = document.getElementById("motPasse").value;
      var mdp2 = document.getElementById("motPasse2").value;

      if (mdp == mdp2) {
        return (true);
      } else {
        alert(ALERTE_MDP);
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



  <FORM action='' method="post" style="width: 30%; margin-right:auto; margin-left:auto;">
    <DIV id="inscription">
      <H1>
        <CENTER><B> <?php echo TXT_ACCUEIL_INSCRIPTION; ?> </B></CENTER>
      </H1>

      <CENTER>

        <TABLE NOBORDER>

          <TR>

            <TD>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder=" " size="50" autocomplete="off" name="nom" value="" required>
                <label for="floatingInput"><?php echo TXT_NOM; ?> : </label>
              </div>
            </TD>

          </TR>

          <TR>

            <TD align=right>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="prenom" value="" required>
                <label for="floatingInput"><?php echo TXT_PRENOM; ?> : </label>
              </div>
            </TD>

          </TR>

          <TR>

            <TD align=right>

              <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="email" value="" required>
                <label for="floatingInput"><?php echo TXT_EMAIL; ?> : </label>
              </div>
            </TD>

          </TR>

          <TR>

            <TD align=right>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="tel" value="" required>
                <label for="floatingInput"><?php echo TXT_TEL; ?> : </label>
              </div>
            </TD>

          </TR>

          <TR>

            <TD>
              <label for="statut"><?php echo TXT_IDENTITE; ?> : </label>


              <SELECT id="statut" name="statut" class="form-select">
                <OPTION>Etudiant</OPTION>
                <OPTION>Enseignant</OPTION>
                <OPTION>Personnel Administratif</OPTION>
              </SELECT>

            </TD>

          </TR>

          <TR>
            <TD>
              <label for="formation"><?php echo TXT_FORMATION; ?> : </label>


              <SELECT id="formation" name="formation" class="form-select">
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
              <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="motPasse" value="" required>
                <label for="floatingInput"><?php echo TXT_MDP_INS; ?> : </label>
              </div>
            </TD>

          </TR>

          <TR>

            <TD align=right>
              <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="motPasse2" value="" required>
                <label for="floatingInput"><?php echo TXT_CONFIRMER_MDP_INS; ?> : </label>
              </div>
            </TD>

          </TR>

        </TABLE>

      </CENTER><br>

    </DIV>

    <div class="legals_flex">
      <CENTER>
        <input id="checkbox_newletter" name="checkbox_confidentiality_notice" required type="checkbox">
        <label class="checkbox_container"><?php echo TXT_CONFIDENTIEL; ?></label><br>
        <input id="checkbox_general_condition" name="checkbox_general_condition" required type="checkbox">
        <label class="checkbox_container"><?php echo TXT_CGU; ?></label>
    </div>

    </center><br>

    <DIV id="Boutons">
      <center>
        <input type="submit" name="inscription" value="<?php echo TXT_ACCUEIL_INSCRIPTION; ?>">
        <input type="reset" value="<?php echo TXT_REINITIALISER; ?>">
        <a href="index.html" type="button" class="btn btn-secondary">Retour</a>
      </CENTER><br>

    </div>
  </FORM>

  <?php
  if (isset($_POST['inscription'])) {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['tel']) && !empty($_POST['motPasse']) && !empty($_POST['motPasse2'])) {
      if (strlen($_POST['motPasse']) >= 4) {
        if ($_POST['motPasse'] == $_POST['motPasse2']) {
          // Cryptage mdp
          $mdp = $_POST['motPasse'];
          $mdp_crypté = sha1($mdp);

          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $email = $_POST['email'];
          $tel = $_POST['tel'];
          $statut = $_POST['statut'];
          $formation = $_POST['formation'];

          $query = "INSERT INTO personne (IdentifiantPe, NomPe, PrenomPe, EmailPe, Mot_de_passePe, TelPe, Statut, Formation)
        VALUES ('$email', '$nom', '$prenom', '$email', '$mdp_crypté', '$tel', '$statut', '$formation')";
          $result = mysqli_query($session, $query);

          $_SESSION['user'] = $email;

  ?>
          <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <div>
                      Le compte a été créé avec succès !
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col text-center">
                    <a type="button" class="btn btn-primary" href="reservation_portable.php">Valider</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php
          echo "<script>
                        $(window).load(function() {
                            $('#alerte').modal('show');
                        });
                    </script>";
        } else {
        ?>
          <div style="margin-left: auto; margin-right: auto; width: 30%;">
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
              </svg>
              <div style="margin-left: auto; margin-right: auto;">
                Les mots de passes ne correspondent pas. Veuillez recommencer !
              </div>
            </div>
          </div>
        <?php
        }
      } else {
        ?>

        <div style="margin-left: auto; margin-right: auto; width: 30%;">
          <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div style="margin-left: auto; margin-right: auto;">
              Le mot de passe choisi est trop court !
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      ?>
      <div style="margin-left: auto; margin-right: auto; width: 15%;">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </svg>
          <div style="margin-left: auto; margin-right: auto;">
            Veuillez remplir tous les champs !
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
</body>

</html>