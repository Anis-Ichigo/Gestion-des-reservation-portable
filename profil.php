<?php
session_start();
require('Connexion_BD.php');
mysqli_set_charset($session, "utf-8");
require('decide-lang.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo TXT_ACCUEIL_PROFIL; ?></title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="styletest.css" type="text/css">
    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>



<body>
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
                               WHERE emprunt.IdentifiantM = materiel.identifiantM
                               AND emprunt.identifiantPe = personne.IdentifiantPe
                               AND materiel.CategorieM = '$CategorieM'
                               AND personne.IdentifiantPe = $identifiant");

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

        $modif_profil = ("UPDATE personne SET PrenomPe = '$modif_PrenomPe', NomPe = '$modif_NomPe', EmailPe = '$modif_EmailPe', AdressePe = '$modif_AdressePe', TelPe = '$modif_TelPe', Statut = '$modif_Statut', Formation = '$modif_Formation' WHERE IdentifiantPe = $identifiant");
        $result_modif_profil = mysqli_query($session, $modif_profil);
    }

    $emprunteur = ("SELECT * FROM personne where IdentifiantPe = '$identifiant'");
    $result_emprunteur = mysqli_query($session, $emprunteur);
    foreach ($result_emprunteur as $row) {
    ?>

        <main>

            <div class="contenu">
                <h1> <?php echo TXT_ACCUEIL_PROFIL; ?></h1>


                <div style="width: 30%;float :left;">
                    <FORM method="POST" action="profil.php">
                        <div class="form-group row">
                            <H2><?php echo TXT_INFORMATION; ?></H2>

                            <TABLE NOBOARDER style="display:inline">
                                <TR>
                                    <TD>
                                        <label><?php echo TXT_PRENOM; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="PrenomPe" value="<?php echo $row['PrenomPe']; ?>">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>
                                        <label><?php echo TXT_NOM; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="NomPe" value="<?php echo $row['NomPe']; ?>">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>
                                        <label><?php echo TXT_EMAIL; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="EmailPe" value="<?php echo $row['EmailPe']; ?>">
                                    </TD>
                                </TR>
                                <TR>
                                    <TD>
                                        <label><?php echo TXT_ADRESSE; ?> :</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="AdressePe" value="<?php echo $row['AdressePe']; ?>">
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <label><?php echo TXT_TEL; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="TelPe" value="<?php echo $row['TelPe']; ?>">
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <label><?php echo TXT_IDENTITE; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="Statut" value="<?php echo $row['Statut']; ?>">
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <label><?php echo TXT_FORMATION; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" readonly class="form-control-plaintext" name="Formation" value="<?php echo $row['Formation']; ?>">
                                    </TD>
                                </TR>


                            </TABLE>

                            <br>
                            <p>
                                <input type="submit" name="modifier_profil" class="btn btn-primary" value="<?php echo TXT_MODIFP; ?>">
                            </p>
                        </div>
                    </FORM>
                </div>

            <?php
        }
            ?>

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

                <div style="width: 70%; float:left; ">
                    <h2><?php echo TXT_RDV; ?></h2>

                    <Table class="table table-striped table-hover">

                        <TR>
                            <TH>
                                <?php echo TXT_NUMERO; ?>
                            </TH>

                            <TH>
                                <?php echo TXT_TYPE; ?>
                            </TH>

                            <TH>
                                <?php echo TXT_DATE; ?>
                            </TH>

                            <TH>
                                <?php echo  TXT_HEURE; ?>
                            </TH>

                        </TR>

                        <?php


                        foreach ($result_reservations as $row) {

                        ?>

                            <tr>
                                <td>
                                    <?php echo $row['IdentifiantM'] ?>
                                </td>

                                <td>
                                    <?php echo $row['CategorieM'] ?>
                                </td>

                                <td>
                                    <?php echo $row['DateEmprunt'] ?>
                                </td>

                                <td>
                                    <?php echo $row['HoraireCal'] ?>
                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>

                    </Table>
                </div>


            </div>


            <td>
            <H2><?php echo TXT_MODIFMDP; ?></H2>

                <div id="modifmdp">

                    <FORM method="POST" action="profil.php">

                        <Table>
                            <TR>
                                <TD>
                                    <label><?php echo TXT_ANCIENMDP; ?>:</label>
                                </TD>

                                <TD>
                                    <input type="password" class="form-control" autocomplete="off" name="mdp_actuel" value="">
                                </TD>
                            </TR>

                            <TR>
                                <TD>
                                    <label><?php echo TXT_NOUVEAUMDP; ?>:</label>
                                </TD>
                                <TD>
                                    <input type="password" class="form-control" autocomplete="off" name="mdp_nouveau" value="">
                                </TD>
                            </TR>

                            <TR>
                                <TD>
                                    <label><?php echo TXT_CONFIRMERMDP; ?> :</label>
                                </TD>
                                <TD>
                                    <input type="password" class="form-control" autocomplete="off" name="mdp_confirmer" value="">
                                </TD>
                            </TR>
                        </TABLE>

                        <br>

                        <p>
                            <input type="submit" class="btn btn-primary" name="modifier_mdp" value="<?php echo TXT_MODIFMDP; ?>">
                        </p>

                    </Form>

                    <?php
                    if(isset($_POST['mdp_actuel'])){
                      $actuel = $_POST['mdp_actuel'];
                      $mdp = $_POST['mdp_nouveau'];
                      $confirmer = $_POST['mdp_confirmer'];
                      updateMdp($session, $identifiant, $actuel, $mdp, $confirmer);
                    }

                  function updateMdp($session, $identifiant, $actuel, $mdp, $confirmer){
                    $query = "UPDATE personne SET Mot_de_passePe = ? WHERE IdentifiantPe = $identifiant";
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
                                if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', $mdp)) {

                                    $mdp = sha1($mdp);
                                    $req2 = mysqli_prepare($session, $query);
                                    mysqli_stmt_bind_param($req2, 's', $mdp);
                                    if (mysqli_stmt_execute($req2)) { //modifier avec success
                                        echo SUCCES_MDP;
                                    }
                                } else //erreur
                                    echo ERREUR_MDP;
                            } else //mot de passe ne sont pas identiques
                                echo MDP_DIFFERENT;
                        } else //mot de passe actuel incorrect
                            echo MDP_INCORRECT;
                    } else {  //manque un champs
                        echo MDP_INCOMPLET;
                    }
                  }
                    ?>
                </div>

            </td>

            <?php

            if (isset($_POST['modifier_profil'])) {
            ?>
                <FORM method="POST" action="profil.php">
                    <div class="modal fade" id="alerte" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_PrenomPe" value="<?php echo $_POST["PrenomPe"]; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_PRENOM; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_NomPe" value="<?php echo $_POST['NomPe']; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_NOM; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_EmailPe" value="<?php echo $_POST['EmailPe']; ?>" required>
                                        <label for="floatingInput"><?php echo TXT_EMAIL; ?></label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder=" " autocomplete="off" name="modif_AdressePe" value="<?php echo $_POST['AdressePe']; ?>" required>
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
                <a href="menu2.php" type="button" class="btn btn-secondary">Retour</a>
            </div>

        </main>

</body>


</html>
