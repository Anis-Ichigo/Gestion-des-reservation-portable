<?php
require('decide-lang.php');
require('Connexion_BD.php');
mysqli_set_charset($session, "utf-8");
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo TXT_ACCUEIL_PROFIL; ?></title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="Styletest.css" type="text/css">
    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>



<body>

    <div class="header">
        <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="width: 100%; margin-top: 1%">
    </div>

    <div style="float: right; display:inline">
        <div class="element-head">
            <?php echo $_SESSION['nom']; ?>
            <a href="deconnexion.php" type="button" class="btn btn-default"><i class="fi-rr-sign-out"></i></a>
        </div>
    </div>

    <?php
    $identifiant = $_SESSION['identifiant'];
    //$identifiant = '22508753';

    if (isset($_POST['envoyer_probleme'])) {
        $NomP = addslashes($_POST['NomP']);
        $DateProbleme = strftime('%Y-%m-%d');
        $Description = addslashes($_POST['Description']);
        $CategorieM = $_POST['CategorieM'];
        $categorie = ("SELECT *
                               FROM emprunt, materiel, personne
                               WHERE emprunt.IdentifiantM = materiel.IdentifiantM
                               AND emprunt.identifiantPe = personne.IdentifiantPe
                               AND materiel.CategorieM = '$CategorieM'
                               AND personne.IdentifiantPe = '$identifiant'");

        $result_categorie = mysqli_query($session, $categorie);

        foreach ($result_categorie as $row) {
            $IdentifiantM = $row['IdentifiantM'];
        }

        $probleme = ("INSERT INTO `probleme`(`NomP`, `DateProbleme`, `DateResolution`, `Resolution`, `Description`, `IdentifiantPe`, `IdentifiantM`)
                VALUES ('$NomP', '$DateProbleme', NULL, 'Non résolu', '$Description', '$identifiant', '$IdentifiantM')");

        $result_probleme = mysqli_query($session, $probleme);
        $etat_non_dispo = "UPDATE materiel SET EtatM = 'Non Dispo' WHERE IdentifiantM = '$IdentifiantM'";
        $result_etat_non_dispo = mysqli_query($session, $etat_non_dispo);
    }

    if (isset($_POST['modifier'])) {

        $modif_PrenomPe = $_POST['modif_PrenomPe'];
        $modif_NomPe = $_POST['modif_NomPe'];
        $modif_EmailPe = $_POST['modif_EmailPe'];
        $modif_AdressePe = addslashes($_POST['modif_AdressePe']);
        $modif_TelPe = $_POST['modif_TelPe'];
        $modif_Statut = $_POST['modif_Statut'];
        $modif_Formation = $_POST['modif_Formation'];

        $modif_profil = ("UPDATE personne SET PrenomPe = '$modif_PrenomPe', NomPe = '$modif_NomPe', EmailPe = '$modif_EmailPe', AdressePe = '$modif_AdressePe', TelPe = '$modif_TelPe', Statut = '$modif_Statut', Formation = '$modif_Formation' WHERE IdentifiantPe = '$identifiant'");
        $result_modif_profil = mysqli_query($session, $modif_profil);
    }

    $emprunteur = ("SELECT * FROM personne where IdentifiantPe = '$identifiant'");
    $result_emprunteur = mysqli_query($session, $emprunteur);
    foreach ($result_emprunteur as $row) {
    ?>

        <main>

            <div class="contenu">
                <h1 style="display: block ;text-align :center;"> <?php echo TXT_ACCUEIL_PROFIL; ?></h1>


                <div style="display: block ;text-align :center;">
                    <FORM method="POST" action="profil.php">
                        <div style="display: block ;text-align :center;" class="form-group row">
                            <input type="button" class="accordion" value="<?php echo TXT_INFORMATION; ?>">
                            <!-- <H2><?php echo TXT_INFORMATION; ?></H2> -->

                            <div class="panel" style=" text-align: center">
                                <TABLE NOBOARDER style="display:inline; text-align: center">
                                    <TR>

                                        <TD style="text-align : left">
                                            <?php echo TXT_PRENOM; ?>:
                                        </TD>
                                        <TD style="text-align : left">
                                            <input type="text" readonly class="form-control-plaintext" name="PrenomPe" value="<?php echo $row['PrenomPe']; ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_NOM; ?>:
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="NomPe" value="<?php echo $row['NomPe']; ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_EMAIL; ?>:
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="EmailPe" value="<?php echo $row['EmailPe']; ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_ADRESSE; ?> :
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="AdressePe" value="<?php echo $row['AdressePe']; ?>">
                                        </TD>
                                    </TR>

                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_TEL; ?>:
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="TelPe" value="<?php echo $row['TelPe']; ?>">
                                        </TD>
                                    </TR>

                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_IDENTITE; ?>:
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="Statut" value="<?php echo $row['Statut']; ?>">
                                        </TD>
                                    </TR>

                                    <TR>
                                        <TD style="text-align : left">
                                            <?php echo TXT_FORMATION; ?>:
                                        </TD>
                                        <TD>
                                            <input type="text" readonly class="form-control-plaintext" name="Formation" value="<?php echo $row['Formation']; ?>">
                                        </TD>
                                    </TR>


                                </TABLE>

                                <br><br>
                                <p>
                                    <input type="submit" name="modifier_profil" class="btn btn-primary" value="<?php echo TXT_MODIFP; ?>">
                                    <br><br>
                                    <input type="submit" class="btn btn-primary" name="modifier_mdp2" value="<?php echo TXT_MODIFMDP; ?>">
                                </p>
                            </div>
                        </div>
                    </FORM>
                </div>



            <?php
        }
            ?>
            <div id="modifmdp">
                <?php
                if (isset($_POST['modifier_mdp2'])) {
                ?>
                    <FORM method="POST" action="profil.php">
                        <div class="modal fade" id="mdp" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" autocomplete="off" name="mdp_actuel" placeholder=" " value="" required>
                                            <label for="floatingInput"><?php echo TXT_ANCIENMDP; ?>:</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" autocomplete="off" name="mdp_nouveau" placeholder=" " value="" required>
                                            <label for="floatingInput"><?php echo TXT_NOUVEAUMDP; ?>:</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" autocomplete="off" name="mdp_confirmer" placeholder=" " value="" required>
                                            <label for="floatingInput"><?php echo TXT_CONFIRMERMDP; ?> :</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="col text-center">
                                            <input type="submit" class="btn btn-primary" name="modifier_mdp" value="<?php echo TXT_MODIFMDP; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        echo "<script>
                    $(window).load(function() {
                    $('#mdp').modal('show');
                    });
                </script>";
                        ?>
                    </FORM>


                <?php
                }
                ?>

                <?php
                if (isset($_POST['mdp_actuel'])) {
                    $actuel = $_POST['mdp_actuel'];
                    $mdp = $_POST['mdp_nouveau'];
                    $confirmer = $_POST['mdp_confirmer'];
                    updateMdp($session, $identifiant, $actuel, $mdp, $confirmer);
                }

                function updateMdp($session, $identifiant, $actuel, $mdp, $confirmer)
                {
                    $query = "UPDATE personne SET Mot_de_passePe = ? WHERE IdentifiantPe = '$identifiant'";
                    if (!empty($actuel) && !empty($mdp) && !empty($confirmer)) {
                        $query_pe = "SELECT Mot_de_passePe FROM personne WHERE IdentifiantPe = ?";
                        $req = mysqli_prepare($session, $query_pe);
                        mysqli_stmt_bind_param($req, 's', $identifiant);
                        mysqli_stmt_execute($req);
                        $result = mysqli_stmt_get_result($req);
                        $ligne = mysqli_fetch_assoc($result);
                        $bd_mdp = $ligne['Mot_de_passePe'];
                        $actuel = sha1($actuel);

                        if ($actuel == $bd_mdp) {
                            if ($mdp === $confirmer) {
                                //if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', $mdp)) {
                                $mdp = sha1($mdp);
                                $req2 = mysqli_prepare($session, $query);
                                mysqli_stmt_bind_param($req2, 's', $mdp);
                                if (mysqli_stmt_execute($req2)) {

                                    // modifier avec success
                ?>

                                    <div class="modal fade" id="succes_mdp" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        </svg>

                                                        <div>
                                                            <?php echo SUCCES_MDP; ?>
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
            $('#succes_mdp').modal('show');
        });
    </script>";
                                }
                                //} else //erreur
                                //  echo ERREUR_MDP;
                            } else {
                                ?>
                                <div class="modal fade" id="mdp_different" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                    </svg>
                                                    <div>
                                                        <?php echo MDP_DIFFERENT; ?>
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
                            $('#mdp_different').modal('show');
                        });
                    </script>";
                                //mot de passe ne sont pas identiques
                                ?>


                            <?php
                            }
                        } else { ?>
                            <div class="modal fade" id="mdp_incorrect" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                </svg>
                                                <div>
                                                    <?php echo MDP_INCORRECT; ?>
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
                                    $('#mdp_incorrect').modal('show');
                                    });
                                    </script>";

                            //mot de passe actuel incorrect
                            ?>

                        <?php
                        }
                    } else {  //manque un champs
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
                                                <?php echo MDP_INCOMPLET; ?>
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

                        ?>
                <?php
                    }
                }
                ?>
            </div>
            <?php

            $reservations = ("SELECT *
                                FROM emprunt, personne, materiel, calendrier
                                WHERE emprunt.IdentifiantM = materiel.IdentifiantM
                                AND emprunt.IdentifiantPe = personne.IdentifiantPe
                                AND emprunt.IdentifiantCal = calendrier.IdentifiantCal
                                AND personne.IdentifiantPe = '$identifiant'");

            $result_reservations = mysqli_query($session, $reservations);
            $nb_lignes = mysqli_num_rows($result_reservations);

            if ($nb_lignes > 0) {
            ?>
                <form action="profil.php" method="post">
                    <div style="display: block ;" class="form-group row">
                        <input type="button" class="accordion mb-3" value="<?php echo TXT_RDV; ?>">
                        <!--<h2><?php echo TXT_RDV; ?></h2> -->

                        <div class="panel">
                            <br>

                            <?php


                            foreach ($result_reservations as $row) {

                            ?>
                                <div class="card">
                                    <div class="card-body">
                                        <input type="hidden" name="CategorieM" value="<?php echo $row['CategorieM']; ?>">
                                        <h5 class="card-title"><?php echo $row['CategorieM'] ?></h5>
                                        <input type="hidden" name="IdentifiantE" value="<?php echo $row['IdentifiantE']; ?>">
                                        <input type="hidden" name="cal" value="<?php echo $row['IdentifiantCal']; ?>">
                                        <input type="hidden" name="DateRetour" value="<?php echo $row['DateRetour']; ?>">
                                        <p class="card-text">
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php echo TXT_DATE; ?>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="DateEmprunt" value="<?php echo $row['DateEmprunt']; ?>">
                                                    <?php $dt = $row['DateEmprunt']; $date = DateTime::createFromFormat('Y-m-d', $dt); $dateAffichee = $date->format('d/m/Y'); echo $dateAffichee; ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <?php echo  TXT_HEURE; ?>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="horaire" value="<?php echo $row['HoraireCal']; ?>">
                                                    <?php echo $row['HoraireCal'] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style=" width: 60%">
                                                    <?php echo TXT_NUMERO; ?>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="IdentifiantM" value="<?php echo $row['IdentifiantM'] . "  "; ?>">
                                                    <?php echo "  " . $row['IdentifiantM'] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <?php echo  TXT_BUREAU; ?>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>

                                        </table>
                                        </p>
                                        <input type='submit' class='btn btn-primary' name='supprimer_rdv' data-bs-toggle='modal' data-bs-target='#exampleModal' value='<?php echo TXT_SUPPRIMER; ?>'>
                                        <input type='submit' class='btn btn-primary' name='modifier_rdv' data-bs-toggle='modal' data-bs-target='#exampleModal' value='<?php echo TXT_MODIFIER ?>' style="float:right;">
                                    </div>
                                </div>
                                <br>

                        <?php
                            }
                        }
                        ?>
                </form>

            </div>
            </div>


            </div>


            <?php

            if (isset($_POST['modifier_profil'])) {

            ?>
                <FORM method="POST" action="profil.php">
                    <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_PrenomPe" value="<?php echo $_POST["PrenomPe"]; ?>" readonly>
                                        <label for="floatingInput"><?php echo TXT_PRENOM; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_NomPe" value="<?php echo $_POST['NomPe']; ?>" readonly>
                                        <label for="floatingInput"><?php echo TXT_NOM; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_EmailPe" value="<?php echo $_POST['EmailPe']; ?>" pattern="^[a-zA-Z0-9_-\.]+@ut-capitole\.fr$" required>
                                        <label for="floatingInput"><?php echo TXT_EMAIL; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_AdressePe" value="<?php echo $_POST['AdressePe']; ?>">
                                        <label for="floatingInput"><?php echo TXT_ADRESSE; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_TelPe" value="<?php echo $_POST['TelPe']; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_TEL; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_Statut" value="<?php echo $_POST['Statut']; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_IDENTITE; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_Formation" value="<?php echo $_POST['Formation']; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_FORMATION; ?></label>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <div class="col text-center">
                                        <input type="submit" name="modifier" class="btn btn-primary" value="<?php echo TXT_MODIFIER; ?>">
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
                    ?>
                </FORM>
            <?php
            }
            ?>

            <div class="text-center">
                <a href="menu3.php" type="button" class="btn btn-secondary"><?php echo TXT_MENU; ?></a>
            </div>

            <script>
                var acc = document.getElementsByClassName("accordion");
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

            <!-- suppression_modification -->
            <?php
            if (isset($_POST['supprimer_rdv'])) {

            ?>
                <form action="profil.php" method="POST">
                    <div class="modal fade" id="alerte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo TXT_CONFIRMATION_SUPPRESSION_RDV; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" name="identiE" value="<?php echo $_POST['IdentifiantE']; ?>">
                                    <input type="hidden" name="cal" value="<?php echo $_POST['cal']; ?>">

                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CHOIX_MATERIEL; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="CategorieM" value="<?php echo $_POST['CategorieM'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_NUMERO; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="IdentifiantM" value="<?php echo $_POST['IdentifiantM']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CHOIX_DATE; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="date" value="<?php echo $dateAffichee; ?>" readonly>
                                            <input type="hidden" class="form-control-plaintext" name="date_emprunt" value="<?php echo $_POST['DateEmprunt']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_CRENEAU; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="horaire" value="<?php echo $_POST['horaire']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col col-form-label"><?php echo TXT_BUREAU; ?> : </label>
                                        <div class="col">
                                            <input type="text" class="form-control-plaintext" name="bureau" value="" readonly>
                                        </div>
                                    </div>


                                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                        </svg>
                                        <div>
                                            <?php echo TXT_INFO_SUPPRESSION; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="<?php echo TXT_RETOUR; ?>">
                                    <input type="submit" class="btn btn-primary" name="confirmer" value="<?php echo TXT_CONFIRMER; ?>">
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
                if (isset($_POST['confirmer'])) {
                    $identifiantCal = $_POST['cal'];
                    $date_emprunt = $_POST["date_emprunt"];
                    $horaire = $_POST["horaire"];
                    $identifiantM = $_POST["IdentifiantM"];
                    $identifiantE = $_POST['identiE'];

                    $emprunter = ("UPDATE calendrier SET EtatCal = 'Disponible' WHERE IdentifiantCal = '$identifiantCal'");
                    $result_emprunter = mysqli_query($session, $emprunter);

                    $etat_materiel = ("UPDATE materiel SET EtatM = 'Dispo' WHERE IdentifiantM = '$identifiantM'");
                    $result_etat_materiel = mysqli_query($session, $etat_materiel);



                    $delete_rdv = ("DELETE FROM `emprunt`
                            WHERE      IdentifiantE = '$identifiantE'
                            AND         IdentifiantPe = '$identifiant'");
                    $result_delete_rdv = mysqli_query($session, $delete_rdv);

                ?>

                    <div class="modal fade" id="suppression" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                        <div>

                                            <?php echo TXT_ALERTE_SUCCES_SUPPRESSION; ?>
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
            $('#suppression').modal('show');
        });
    </script>";
                }
                ?>


                <script>
                    /*var myModal = document.getElementById('exampleModal')
                    var myInput = document.getElementById('myInput')

                    myModal.addEventListener('shown.bs.modal', function() {
                        myInput.focus()
                    })*/
                </script>



                <?php
                if (isset($_POST['modifier_rdv'])) {
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
                        if(strftime('%A', $dateRetour) == "Saturday" || strftime('%A', $dateRetour) == "Sunday"){
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



        </main>

</body>

</html>
