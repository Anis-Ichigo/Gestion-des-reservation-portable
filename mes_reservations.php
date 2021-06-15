<?php
require('decide-lang.php');
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");
date_default_timezone_set('Europe/Paris');
?>

<!DOCTYPE html>

<html>



<head>

    <title><?php echo TXT_ACCUEIL_RESERVATION; ?></title>

    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="styletest.css" />
    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>



<body>

    <div class="header">
        <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="width: 100%; margin-top: 1%">
    </div>




    <?php

    $identifiant = $_SESSION['user'];

    //$identifiant = '22508753';

    $utilisateur = "SELECT * FROM personne WHERE IdentifiantPe = '$identifiant'";

    $result_utilisateur = mysqli_query($session, $utilisateur);

    foreach ($result_utilisateur as $row) {
        $Prenom = $row['PrenomPe'];
        $Nom = $row['NomPe'];
    }



    ?>


    <div style="float: right; display:inline">
        <div class="element-head">

            <?php echo $_SESSION['nom']; ?>
            <a href="deconnexion.php" type="button" class="btn btn-default"><i class="fi-rr-sign-out"></i></a>
        </div>
    </div>

    <div class="text-center">
        <h2 style="display: inline;"><?php echo TXT_ACCUEIL_RESERVATION; ?></h2>
    </div>

    <br>


    <?php

    $reservations = ("SELECT *
                        FROM emprunt, materiel, personne
                        WHERE emprunt.IdentifiantM = materiel.IdentifiantM
                        AND emprunt.IdentifiantPe = personne.IdentifiantPe
                        AND emprunt.Motif LIKE 'Acquisition'
                        AND emprunt.IdentifiantPe = '$identifiant'");

    $result_reservations = mysqli_query($session, $reservations);

    foreach ($result_reservations as $row) {

    ?>
        <form action="" method="POST">

            <input type="hidden" name="IdentifiantE" value="<?php echo $row['IdentifiantE']; ?>">

            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['CategorieM'] ?></h5>
                    <p class="card-text">
                    <table>
                        <tr>
                            <td>
                                <?php echo TXT_NUMERO; ?>
                            </td>
                            <td>
                                <input type="text" readonly class="form-control-plaintext text-center" name="IdentifiantM" value="<?php echo $row['IdentifiantM'] ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php echo TXT_RETRAIT; ?>
                            </td>
                            <td>
                                <input type="hidden" readonly class="form-control-plaintext text-center" name="DateEmprunt" value="<?php echo $row['DateEmprunt'] ?>">
                                <input type="text" value="<?php $dt = $row['DateEmprunt'];
                                                            $date = DateTime::createFromFormat('Y-m-d', $dt);
                                                            $dateAffichee = $date->format('d/m/Y');
                                                            echo $dateAffichee; ?>" class="form-control-plaintext text-center" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php echo TXT_DATER; ?>
                            </td>
                            <td>
                                <input type="hidden" readonly class="form-control-plaintext text-center" name="DateRetour" value="<?php echo $row['DateRetour'] ?>">
                                <input type="text" value="<?php $dt = $row['DateRetour'];
                                                            $date = DateTime::createFromFormat('Y-m-d', $dt);
                                                            $dateAffichee = $date->format('d/m/Y');
                                                            echo $dateAffichee; ?>" class="form-control-plaintext text-center" readonly>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php echo TXT_TYPE; ?>
                            </td>
                            <td>
                                <input type="text" readonly class="form-control-plaintext text-center" name="CategorieM" value="<?php echo $row['CategorieM'] ?>">
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary mb-2" name="prolonger" value="<?php echo TXT_PROLONGER; ?>">
                        <input type="submit" class="btn btn-primary mb-2" name="probleme" value="<?php echo TXT_PROBLEME; ?>">
                        <input type="submit" class="btn btn-primary mb-2" name="restituer" value="<?php echo TXT_RESTITUER; ?>">
                    </div>

                </div>
            </div>
        </form>


    <?php
    }
    ?>

    <?php
    if (isset($_POST['prolonger'])) {
    ?>

        <form action="" method="POST">

            <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
            <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
            <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td>
                                        <label><?php echo TXT_DATERA; ?> : </label>
                                    </td>

                                    <td>
                                        <input type="date" name="DateRetour" value="<?php echo $_POST['DateRetour'] ?>" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label><?php echo TXT_DATERS; ?> : </label>
                                    </td>

                                    <td>
                                        <input type="date" name="DateProlongation">
                                    </td>
                                </tr>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <div class="col text-center">
                                <input type="submit" class="btn btn-primary" name="confirmer_prolongation" value="<?php echo TXT_CONFIRMER; ?>">
                                <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="<?php echo TXT_ANNULER; ?>">
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
    }
        ?>

        </form>

        <?php

        if (isset($_POST['confirmer_prolongation'])) {
          $jour_p = $_POST['DateProlongation'];
        if(strftime('%A', strtotime($jour_p)) == "Saturday" || strftime('%A', strtotime($jour_p)) == "Sunday" ){
          ?>
          <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-body">
                          <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>

                              <div>
                                  <?php echo TXT_ERREUR_DATE; ?>
                              </div>
                          </div>
                      </div>

                      <div class="modal-footer">
                          <div class="col text-center">
                              <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo TXT_OK; ?>">
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
        }else{




            $identifiantE = $_POST['IdentifiantE'];
            $identifiantM = $_POST['IdentifiantM'];
            $dateProlongation = $_POST['DateProlongation'];
            $dateDuJour = strftime('%Y-%m-%d');

            if ($dateProlongation >= $dateDuJour) {
                $query_demander_prolongation = "UPDATE emprunt SET DateProlongation = '$dateProlongation' WHERE IdentifiantE = '$identifiantE' ";
                $result_demande_prolongation = mysqli_query($session, $query_demander_prolongation);
                $query_en_attente = "UPDATE materiel SET EtatM = 'En attente' WHERE IdentifiantM = '$identifiantM'";
                $result_en_attente = mysqli_query($session, $query_en_attente);
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
                                        <?php echo TXT_ALERTE_SUCCES_PROLONGATION; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col text-center">
                                    <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo TXT_OK; ?>">
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

                <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                    </svg>
                                    <div>
                                        <?php echo TXT_ERREUR_DATE; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col text-center">
                                    <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo TXT_OK; ?>">
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
            }
        }
    }
        ?>

        <?php
        if (isset($_POST['probleme'])) {
        ?>
            <form action="" method="POST">
                <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
                <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
                <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="titre" autocomplete="off" placeholder=" " required>
                                    <label for="floatingInput"><?php echo TXT_TITRE; ?></label>
                                </div>

                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="floatingTextarea" style="height: 200px" name="description" cols="60" rows="10" autocomplete="off" placeholder=" " required></textarea>
                                    <label for="floatingTextarea"><?php echo TXT_DESCRIPTION; ?></label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col text-center">
                                    <input type="submit" class="btn btn-primary" name="confirmer_probleme" value="<?php echo TXT_ENVOYER; ?>">
                                    <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="<?php echo TXT_ANNULER; ?>">
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
        }


        if (isset($_POST['confirmer_probleme'])) {

            $NomP = addslashes($_POST['titre']);
            $DateProbleme = strftime('%Y-%m-%d');
            $Description = addslashes($_POST['description']);

            $IdentifiantM = $_POST['IdentifiantM'];


            $probleme = ("INSERT INTO `probleme`(`NomP`, `DateProbleme`, `DateResolution`, `Resolution`, `Description`, `IdentifiantPe`, `IdentifiantM`)
        VALUES ('$NomP', '$DateProbleme', NULL, 'Non résolu', '$Description', '$identifiant', '$IdentifiantM')");
            $result_probleme = mysqli_query($session, $probleme);

            $etat_non_dispo = "UPDATE materiel SET EtatM = 'Non Dispo' WHERE IdentifiantM = '$IdentifiantM'";
            $result_etat_non_dispo = mysqli_query($session, $etat_non_dispo);

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
                                        <?php echo TXT_ALERTE_SUCCES_DEMANDE; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col text-center">
                                    <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo TXT_OK; ?>">
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
        }


        if (isset($_POST['restituer'])) {

            ?>



                <FORM method="POST" action="profil.php">

                    <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
                    <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
                    <input type="hidden" name="DateEmprunt" value="<?php echo $_POST['DateEmprunt']; ?>">
                    <input type="hidden" name="DateRetour" value="<?php echo $_POST['DateRetour']; ?>">
                    <input type="hidden" name="CategorieM" value="<?php echo $_POST['CategorieM']; ?>">

                    <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <?php $date_res = $_POST['DateRetour'] ?>
                                    <?php $jour_res = strftime('%A', strtotime($date_res)) ?>

                                    <?php if ($jour_res == 'Monday') {
                                    ?>
                                        <input type="button" class="accordion accordion_modif" value="<?php
                                                                                                        $premierJour = strftime("%d/%m/%Y", strtotime("monday"));
                                                                                                        echo TXT_LUNDI . " $premierJour";
                                                                                                        ?>">

                                        <div class="panel">
                                            <table class="table">
                                                <?php

                                                if ($premierJour == Date("d/m/Y")) {
                                                    $HeureActuelle = date('H:i:s', time());
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle' ";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                } else {
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible'";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                }
                                                if ($num > 0) {
                                                    for ($i = 0; $i < $num; $i++) {
                                                        $row = mysqli_fetch_array($res);
                                                        $horaire = date("H:i", strtotime($row['HoraireCal']));
                                                        if ($i % 3 == 0) echo '<tr>';
                                                        echo "<td>" . "<input type='submit' class='btn btn-primary' name='Lundi' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$horaire'>" . "</td>";
                                                    }
                                                }
                                                mysqli_free_result($res);

                                                ?>
                                            </table>

                                        </div>

                                    <?php
                                    } else if ($jour_res == 'Tuesday') {
                                    ?>


                                        <input type="button" class="accordion accordion_modif" value="<?php
                                                                                                        $premierJour = strftime("%d/%m/%Y", strtotime("tuesday"));
                                                                                                        echo TXT_MARDI . " $premierJour";
                                                                                                        ?>">

                                        <div class="panel">
                                            <table class="table">
                                                <?php

                                                if ($premierJour == Date("d/m/Y")) {
                                                    $HeureActuelle = date('H:i:s', time());
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Mardi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle' ";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                } else {
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Mardi' AND EtatCal = 'Disponible'";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                }
                                                if ($num > 0) {
                                                    for ($i = 0; $i < $num; $i++) {
                                                        $row = mysqli_fetch_array($res);
                                                        $horaire = date("H:i", strtotime($row['HoraireCal']));
                                                        if ($i % 3 == 0) echo '<tr>';
                                                        echo "<td>" . "<input type='submit' class='btn btn-primary' name='Mardi' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$horaire'>" . "</td>";
                                                    }
                                                }
                                                mysqli_free_result($res);

                                                ?>
                                            </table>
                                        </div>

                                    <?php
                                    } else if ($jour_res == 'Wednesday') {
                                    ?>


                                        <input type="button" class="accordion accordion_modif" value="<?php
                                                                                                        $premierJour = strftime("%d/%m/%Y", strtotime("wednesday"));
                                                                                                        echo TXT_MERCREDI . " $premierJour";
                                                                                                        ?>">

                                        <div class="panel">
                                            <table class="table">

                                                <?php

                                                if ($premierJour == Date("d/m/Y")) {
                                                    $HeureActuelle = date('H:i:s', time());
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Mercredi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle' ";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                } else {
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Mercredi' AND EtatCal = 'Disponible'";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                }
                                                if ($num > 0) {
                                                    for ($i = 0; $i < $num; $i++) {
                                                        $row = mysqli_fetch_array($res);
                                                        $horaire = date("H:i", strtotime($row['HoraireCal']));
                                                        if ($i % 3 == 0) echo '<tr>';
                                                        echo "<td>" . "<input type='submit' class='btn btn-primary' name='Mercredi' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$horaire'>" . "</td>";
                                                    }
                                                }
                                                mysqli_free_result($res);

                                                ?>
                                            </table>
                                        </div>

                                    <?php
                                    } else if ($jour_res == 'Thursday') {
                                    ?>


                                        <input type="button" class="accordion accordion_modif" value="<?php
                                                                                                        $premierJour = strftime("%d/%m/%Y", strtotime("thursday"));
                                                                                                        echo TXT_JEUDI . " $premierJour";
                                                                                                        ?>">

                                        <div class="panel">
                                            <table class="table">

                                                <?php
                                                if ($premierJour == Date("d/m/Y")) {
                                                    $HeureActuelle = date('H:i:s', time());
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Jeudi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle' ";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                } else {
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Jeudi' AND EtatCal = 'Disponible'";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                }

                                                if ($num > 0) {
                                                    for ($i = 0; $i < $num; $i++) {
                                                        $row = mysqli_fetch_array($res);
                                                        $horaire = date("H:i", strtotime($row['HoraireCal']));
                                                        if ($i % 3 == 0) echo '<tr>';
                                                        echo "<td>" . "<input type='submit' class='btn btn-primary' name='Jeudi' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$horaire'>" . "</td>";
                                                    }
                                                }
                                                mysqli_free_result($res);
                                                ?>
                                            </table>
                                        </div>

                                    <?php
                                    } else if ($jour_res == 'Friday') {
                                    ?>

                                        <!-- button avec icon
        <button class="accordion">
            <?php
                                        $premierJour = strftime("%d/%m/%Y", strtotime("Friday"));
                                        echo "Vendredi" . " $premierJour";
            ?>
        </button>
        -->

                                        <input type="button" class="accordion accordion_modif" value="<?php
                                                                                                        $premierJour = strftime("%d/%m/%Y", strtotime("friday"));
                                                                                                        echo TXT_VENDREDI . " $premierJour";
                                                                                                        ?>">


                                        <div class="panel">
                                            <table class="table">
                                                <?php
                                                if ($premierJour == Date("d/m/Y")) {
                                                    $HeureActuelle = date('H:i:s', time());
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Vendredi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle' ";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                } else {
                                                    $sql = "SELECT * FROM calendrier WHERE JourCal='Vendredi' AND EtatCal = 'Disponible'";
                                                    $res = mysqli_query($session, $sql);
                                                    $num = mysqli_num_rows($res);
                                                }

                                                if ($num > 0) {
                                                    for ($i = 0; $i < $num; $i++) {
                                                        $row = mysqli_fetch_array($res);
                                                        $horaire = date("H:i", strtotime($row['HoraireCal']));
                                                        if ($i % 3 == 0) echo '<tr>';
                                                        echo "<td>" . "<input type='submit' class='btn btn-primary' name='Vendredi' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$horaire'>" . "</td>";
                                                    }
                                                }
                                                mysqli_free_result($res);
                                                ?>
                                            </table>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                    <script>
                                        /* var myModal = document.getElementById('exampleModal')
                                            var myInput = document.getElementById('myInput')

                                            myModal.addEventListener('shown.bs.modal', function() {
                                                myInput.focus()
                                            })*/
                                    </script>

                                    <!-- Accordion -->
                                    <script>
                                        var acc = document.getElementsByClassName("accordion_modif");
                                        var i;

                                        for (i = 0; i < acc.length; i++) {
                                            acc[i].addEventListener("click", function() {
                                                this.classList.toggle("active");
                                                var panel = this.nextElementSibling;
                                                if (panel.style.maxHeight) {
                                                    panel.style.maxHeight = null;
                                                } else {
                                                    panel.style.maxHeight = panel.scrollHeight + "px";
                                                }
                                            });
                                        }
                                    </script>
                                </div>

                                <div class="modal-footer">
                                    <div class="col text-center">
                                        <input type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal" value="<?php echo TXT_RETOUR; ?>">
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
                    ?>
                </form>

            <?php
        }
            ?>


            <?php
            if (isset($_POST['Lundi']) || isset($_POST['Mardi']) || isset($_POST['Mercredi']) || isset($_POST['Jeudi']) || isset($_POST['Vendredi'])) {
                if (isset($_POST['Lundi'])) {
                    $jour = "Lundi";
                    $horaire = $_POST['Lundi'];
                    $date_emprunt = strftime("%d/%m/%Y", strtotime("monday"));
                } else if (isset($_POST['Mardi'])) {
                    $jour = "Mardi";
                    $horaire = $_POST['Mardi'];
                    $date_emprunt = strftime("%d/%m/%Y", strtotime("tuesday"));
                } else if (isset($_POST['Mercredi'])) {
                    $jour = "Mercredi";
                    $horaire = $_POST['Mercredi'];
                    $date_emprunt = strftime("%d/%m/%Y", strtotime("wednesday"));
                } else if (isset($_POST['Jeudi'])) {
                    $jour = "Jeudi";
                    $horaire = $_POST['Jeudi'];
                    $date_emprunt = strftime("%d/%m/%Y", strtotime("thursday"));
                } else if (isset($_POST['Vendredi'])) {
                    $jour = "Vendredi";
                    $horaire = $_POST['Vendredi'];
                    $date_emprunt = strftime("%d/%m/%Y", strtotime("Friday"));
                }
                $date_retour = strftime("%d/%m/%Y", strtotime($_POST['DateRetour']));
                $categorieM = $_POST['CategorieM'];

                /*$id_materiel = ("SELECT * FROM materiel WHERE EtatM LIKE 'Dispo' AND StatutM LIKE 'Existant' AND CategorieM = '$categorieM' LIMIT 1");
                    $result_id_materiel = mysqli_query($session, $id_materiel);
                    foreach ($result_id_materiel as $materiel) {
                        $IdentifiantM = $materiel['IdentifiantM'];
                    }*/

                $IdentifiantM = $_POST['IdentifiantM'];


                $id_creneau = ("SELECT * FROM calendrier WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
                $result_id_creneau = mysqli_query($session, $id_creneau);
                foreach ($result_id_creneau as $creneau) {
                    $IdentifiantCal = $creneau['IdentifiantCal'];
                }

            ?>
                <!-- Modal -->

                <form action="" method="POST">

                    <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
                    <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
                    <input type="hidden" name="DateEmprunt" value="<?php echo $_POST['DateEmprunt']; ?>">
                    <input type="hidden" name="DateRetour" value="<?php echo $_POST['DateRetour']; ?>">
                    <input type="hidden" name="CategorieM" value="<?php echo $_POST['CategorieM']; ?>">

                    <div class="modal fade" id="alerte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo TXT_CONFIRMATION_RDV; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="IdentifiantM" value="<?php echo $IdentifiantM; ?>">
                                    <input type="hidden" name="IdentifiantCal" value="<?php echo $IdentifiantCal; ?>">
                                    <input type="hidden" name="DateRetour" value="<?php echo $_POST['DateRetour']; ?>">


                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CHOIX_MATERIEL; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="CategorieM" value="<?php echo $categorieM; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CHOIX_DATE; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="date_emprunt" value="<?php echo $date_emprunt; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_DATER; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="date_retour" value="<?php echo $date_retour; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_JOUR; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="jour" value="<?php echo $jour; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CRENEAU; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $horaire; ?>" readonly>
                                        </div>
                                    </div>


                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                        </svg>
                                        <div>
                                            <?php echo TXT_INFO_RESERVATION; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="<?php echo TXT_RETOUR; ?>">
                                    <input type="submit" class="btn btn-primary" name="confirmer_modif_rdv" value="<?php echo TXT_CONFIRMER; ?>">
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
            }
                ?>
                </form>

                <?php
                if (isset($_POST['confirmer_modif_rdv'])) {
                    $dateRetour = $_POST['DateRetour'];

                    $horaire = $_POST['horaire'];
                    $jour = $_POST['jour'];
                    $date_Emprunt = $_POST['date_emprunt'];
                    $dt = DateTime::createFromFormat('d/m/Y', $date_Emprunt);
                    $dateEmprunt = $dt->format('Y-m-d');

                    $categorie = $_POST['CategorieM'];
                    $identifiantM = $_POST['IdentifiantM'];
                    $identifiantCal = $_POST['IdentifiantCal'];

                    $identifiantPe = $identifiant;


                    $emprunt = ("UPDATE calendrier SET EtatCal = 'Indisponible' WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
                    $result_emprunt = mysqli_query($session, $emprunt);


                    $creneau = ("SELECT * FROM calendrier WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
                    $result_creneau = mysqli_query($session, $creneau);
                    foreach ($result_creneau as $row) {
                        $IdentifiantCal = $row['IdentifiantCal'];
                    }

                    $modifier_rdv = ("UPDATE `emprunt` SET DateEmprunt = '$dateEmprunt' , IdentifiantCal= '$IdentifiantCal' WHERE IdentifiantPe = '$identifiant' AND IdentifiantM = '$identifiantM'");
                    $result_insert_rdv = mysqli_query($session, $modifier_rdv);


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

                                            <?php echo TXT_ALERTE_SUCCES_CRENEAU; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col text-center">
                                        <input type="button" class="btn btn-primary" onclick='document.location.href="profil.php"' value="<?php echo TXT_OK; ?> ">
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
                }

                ?>


















































                <!--
                <form action="" method="POST">
                    <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
                    <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
                    <input type="hidden" name="DateEmprunt" value="<?php echo $_POST['DateEmprunt']; ?>">
                    <input type="hidden" name="DateRetour" value="<?php echo $_POST['DateRetour']; ?>">
                    <input type="hidden" name="CategorieM" value="<?php echo $_POST['CategorieM']; ?>">

                    <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <Table class="table table-striped text-center" style="border-collapse:collapse; padding:0px;">

                                        <TR>

                                            <TH>

                                                <?php echo TXT_LUNDI; ?> <br><?php $lundi = strftime("%d/%m/%Y", strtotime("monday"));
                                                                                echo "<input type='text' class='form-control-plaintext text-center' readonly name='date_lundi' value='$lundi'>"; ?>

                                            </TH>

                                            <TH>

                                                <?php echo TXT_MARDI; ?> <br><?php $mardi = strftime("%d/%m/%Y", strtotime("tuesday"));
                                                                                echo "<input type='text' class='form-control-plaintext text-center' readonly name='date_mardi' value='$mardi'>"; ?>

                                            </TH>

                                            <TH>

                                                <?php echo TXT_MERCREDI; ?> <br><?php $mercredi = strftime("%d/%m/%Y", strtotime("wednesday"));
                                                                                echo "<input type='text' class='form-control-plaintext text-center' readonly name='date_mercredi' value='$mercredi'>"; ?>

                                            </TH>

                                            <TH>

                                                <?php echo TXT_JEUDI; ?> <br><?php $jeudi = strftime("%d/%m/%Y", strtotime("thursday"));
                                                                                echo "<input type='text' class='form-control-plaintext text-center' readonly name='date_jeudi' value='$jeudi'>"; ?>

                                            </TH>

                                            <TH>

                                                <?php echo TXT_VENDREDI; ?> <br><?php $vendredi = strftime("%d/%m/%Y", strtotime("friday"));
                                                                                echo "<input type='text' class='form-control-plaintext text-center' readonly name='date_vendredi' value='$vendredi'>"; ?>

                                            </TH>

                                        </TR>


                                        <TD style="border-bottom-width: 0;">

                                            <?php
                                            if ($lundi == Date("d/m/Y")) {
                                                $HeureActuelle = date('H:i:s', time());
                                                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle'");
                                            } else {
                                                $sql = "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible'";
                                                $res = mysqli_query($session, $sql);
                                            }
                                            while ($tab = mysqli_fetch_assoc($res)) {
                                                $horaire = $tab["HoraireCal"];
                                                echo "<Table class='table table-hover text-center' style='border-bottom:white;'> <TR> <TD style='padding: 0px;'><input type='submit' class='btn btn-primary btn-lg' name='horaire_lundi' value='$horaire'> </td></TR> </table>";
                                            }

                                            ?>

                                        </TD>

                                        <TD style="border-bottom-width: 0;">

                                            <?php
                                            if ($mardi == Date("d/m/Y")) {
                                                $HeureActuelle = date('H:i:s', time());
                                                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Mardi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle'");
                                            } else {
                                                $sql = "SELECT * FROM calendrier WHERE JourCal='Mardi' AND EtatCal = 'Disponible'";
                                                $res = mysqli_query($session, $sql);
                                            }
                                            while ($tab = mysqli_fetch_assoc($res)) {

                                                $horaire = $tab["HoraireCal"];

                                                echo "<Table class='table table-hover text-center' style='border-bottom:white;'> <TR> <TD style='padding: 0px;'><input type='submit' class='btn btn-primary btn-lg' name='horaire_mardi' value='$horaire'> </td></TR> </table>";
                                            }

                                            ?>

                                        </TD>

                                        <TD style="border-bottom-width: 0;">

                                            <?php
                                            if ($mercredi == Date("d/m/Y")) {
                                                $HeureActuelle = date('H:i:s', time());
                                                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Mercredi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle'");
                                            } else {
                                                $sql = "SELECT * FROM calendrier WHERE JourCal='Mercredi' AND EtatCal = 'Disponible'";
                                                $res = mysqli_query($session, $sql);
                                            }
                                            while ($tab = mysqli_fetch_assoc($res)) {
                                                $horaire = $tab["HoraireCal"];
                                                echo "<Table class='table table-hover text-center' style='border-bottom:white;'> <TR> <TD style='padding: 0px;'><input type='submit' class='btn btn-primary btn-lg' name='horaire_mercredi' value='$horaire'> </td></TR> </table>";
                                            }
                                            ?>

                                        </TD>

                                        <TD style="border-bottom-width: 0;">

                                            <?php
                                            if ($jeudi == Date("d/m/Y")) {
                                                $HeureActuelle = date('H:i:s', time());
                                                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Jeudi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle'");
                                            } else {
                                                $sql = "SELECT * FROM calendrier WHERE JourCal='Jeudi' AND EtatCal = 'Disponible'";
                                                $res = mysqli_query($session, $sql);
                                            }
                                            while ($tab = mysqli_fetch_assoc($res)) {

                                                $horaire = $tab["HoraireCal"];

                                                echo "<Table class='table table-hover text-center' style='border-bottom:white;'> <TR> <TD style='padding: 0px;'><input type='submit' class='btn btn-primary btn-lg' name='horaire_jeudi' value='$horaire'> </td></TR> </table>";
                                            }

                                            ?>

                                        </TD>

                                        <TD style="border-bottom-width: 0;">

                                            <?php
                                            if ($vendredi == Date("d/m/Y")) {
                                                $HeureActuelle = date('H:i:s', time());
                                                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Vendredi' AND EtatCal = 'Disponible' AND HoraireCal >= '$HeureActuelle'");
                                            } else {
                                                $sql = "SELECT * FROM calendrier WHERE JourCal='Vendredi' AND EtatCal = 'Disponible'";
                                                $res = mysqli_query($session, $sql);
                                            }
                                            while ($tab = mysqli_fetch_assoc($res)) {

                                                $horaire = $tab["HoraireCal"];

                                                echo "<Table class='table table-hover text-center' style='border-bottom:white;'> <TR'> <TD style='padding: 0px;'><input type='submit' class='btn btn-primary btn-lg' name='horaire_vendredi' value='$horaire'> </td></TR> </table>";
                                            }

                                            ?>

                                        </TD>

                                    </Table>

                                    <div class="col text-center">
                                        <input type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal" value="<?php echo TXT_RETOUR; ?>">
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
                //}

                ?>

                <?php
                //if (isset($_POST['horaire_lundi']) || isset($_POST['horaire_mardi']) || isset($_POST['horaire_mercredi']) || isset($_POST['horaire_jeudi']) || isset($_POST['horaire_vendredi'])) {
                ?>


                    <form action="" method="POST">

                        <input type="hidden" name="IdentifiantE" value="<?php echo $_POST['IdentifiantE']; ?>">
                        <input type="hidden" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>">
                        <input type="hidden" name="DateEmprunt" value="<?php echo $_POST['DateEmprunt']; ?>">
                        <input type="hidden" name="DateRetour" value="<?php echo $_POST['DateRetour']; ?>">
                        <input type="hidden" name="CategorieM" value="<?php echo $_POST['CategorieM']; ?>">

                        <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo TXT_CONFIRMATION_RDV; ?></h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div class="mb-2">
                                                <?php echo TXT_TYPE; ?> : <?php echo $_POST['CategorieM']; ?>
                                            </div>

                                            <?php if (isset($_POST['horaire_lundi'])) {
                                            ?>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_DATE; ?> : </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="date_restitution" value="<?php echo strftime("%d/%m/%Y", strtotime("monday")); ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"> <?php echo TXT_HEURE; ?>: </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire_lundi']; ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_BUREAU; ?> : </label>
                                                </div>
                                                <input type="hidden" name="jour" value="Lundi">

                                            <?php
                                            } else if (isset($_POST['horaire_mardi'])) {
                                            ?>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_DATE; ?> : </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="date_restitution" value="<?php echo strftime("%d/%m/%Y", strtotime("tuesday")); ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_HEURE; ?>: </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire_mardi']; ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_BUREAU; ?> : </label>
                                                </div>
                                                <input type="hidden" name="jour" value="Mardi">

                                            <?php
                                            } else if (isset($_POST['horaire_mercredi'])) {
                                            ?>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_DATE; ?> : </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="date_restitution" value="<?php echo strftime("%d/%m/%Y", strtotime("wednesday")); ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_HEURE; ?>: </label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire_mercredi']; ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_BUREAU; ?> : </label>
                                                </div>

                                                <input type="hidden" name="jour" value="Mercredi">

                                            <?php

                                            } else if (isset($_POST['horaire_jeudi'])) {

                                            ?>

                                                <div class="form-group row">

                                                    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_DATE; ?> : </label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control-plaintext" name="date_restitution" value="<?php echo strftime("%d/%m/%Y", strtotime("thursday")); ?>" readonly>

                                                    </div>

                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_HEURE; ?> : </label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire_jeudi']; ?>" readonly>

                                                    </div>

                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_BUREAU; ?> : </label>

                                                </div>

                                                <input type="hidden" name="jour" value="Jeudi">

                                            <?php

                                            } else if (isset($_POST['horaire_vendredi'])) {

                                            ?>

                                                <div class="form-group row">

                                                    <label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_DATE; ?> : </label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control-plaintext" name="date_restitution" value="<?php echo strftime("%d/%m/%Y", strtotime("friday")); ?>" readonly>

                                                    </div>

                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_HEURE; ?> : </label>

                                                    <div class="col-sm-4">

                                                        <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire_vendredi']; ?>" readonly>
                                                    </div>
                                                    <br><label for="staticEmail" class="col-sm-2 col-form-label"><?php echo TXT_BUREAU; ?> : </label>
                                                </div>
                                                <input type="hidden" name="jour" value="Vendredi">

                                            <?php
                                            }
                                            ?>

                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="col text-center">
                                            <input type="submit" class="btn btn-success" name="confirmer_restitution" value="<?php echo TXT_CONFIRMER_RDV; ?>">
                                            <input data-bs-dismiss="modal" class="btn btn-danger" value="<?php echo TXT_ANNULER; ?>">
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
                        ?>

                    </form>

                <?php
                //}

                /*if (isset($_POST['confirmer_restitution'])) {
                    $date_restitution = $_POST['date_restitution'];
                    $horaire = $_POST['horaire'];
                    $jour = $_POST['jour'];
                    $dateEmprunt = $_POST['DateEmprunt'];
                    $dateRetour = $_POST['DateRetour'];
                    $categorie = $_POST['CategorieM'];
                    $identifiantM = $_POST['IdentifiantM'];
                    $identifiantPe = $identifiant;


                    $restitution = ("UPDATE calendrier SET EtatCal = 'Indisponible' WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
                    $result_restitution = mysqli_query($session, $restitution);

                    $creneau = ("SELECT * FROM calendrier WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
                    $result_creneau = mysqli_query($session, $creneau);

                    foreach ($result_creneau as $row) {
                        $IdentifiantCal = $row['IdentifiantCal'];
                    }


                    $insert_rdv = ("INSERT INTO `emprunt`(`DateEmprunt`, `DateRetour`, `DateProlongation`, `Motif`, `IdentifiantM`, `IdentifiantPe`, `IdentifiantCal`)
                    VALUES ('$dateEmprunt', '$dateRetour', NULL, 'Retour', '$identifiantM', '$identifiantPe', '$IdentifiantCal')");

                    $result_insert_rdv = mysqli_query($session, $insert_rdv);*/

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
                                            <?php echo TXT_ALERTE_SUCCES_CRENEAU; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <div class="col text-center">
                                        <input type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo TXT_OK; ?> ">
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
                //}

                ?>

-->

                <div class="text-center">
                    <a href="menu3.php" type="button" class="btn btn-secondary mb-2"><?php echo TXT_MENU; ?></a>
                </div>

</body>

</html>
