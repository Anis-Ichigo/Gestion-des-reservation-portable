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
                                <input type="text" readonly class="form-control-plaintext text-center" name="DateEmprunt" value="<?php echo $row['DateEmprunt'] ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php echo TXT_DATER; ?>
                            </td>
                            <td>
                                <input type="text" readonly class="form-control-plaintext text-center" name="DateRetour" value="<?php echo $row['DateRetour'] ?>">
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

                                            </tD>



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
                }

                    ?>

                    <?php
                    if (isset($_POST['horaire_lundi']) || isset($_POST['horaire_mardi']) || isset($_POST['horaire_mercredi']) || isset($_POST['horaire_jeudi']) || isset($_POST['horaire_vendredi'])) {
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

                    }



                    if (isset($_POST['confirmer_restitution'])) {

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

                        $result_insert_rdv = mysqli_query($session, $insert_rdv);



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
                    }

                    ?>

                    <div class="text-center">
                        <a href="menu3.php" type="button" class="btn btn-secondary mb-2"><?php echo TXT_MENU; ?></a>
                    </div>


</body>



</html>