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



</head>



<body><?php

        //$identifiant = $_SESSION['identifiant'];

        $identifiant = '22508753';

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



        $emprunteur = ("SELECT * FROM personne where IdentifiantPe = $identifiant");

        $result_emprunteur = mysqli_query($session, $emprunteur);

        foreach ($result_emprunteur as $row) {

        ?>

        <div class="mycharts-heading">

            <div class="element-head"> <?php echo $row['PrenomPe']; ?> <?php echo $row['NomPe']; ?><button type="button" id="b1" class="btn btn-default btn-sm"><i class="fi-rr-sign-out"></i></button></div>

        </div>

        <main>


            <div class="contenu">

                <h1> <?php echo TXT_ACCUEIL_PROFIL; ?></h1>

                <div>

                    <FORM method="POST" action="modifier_profil.php">

                        <table>

                            <TR>

                                <TH>
                                    <H2><?php echo TXT_INFORMATION; ?></H2>
                                </th>

                                <th>
                                    <H2><?php echo TXT_MDP; ?></H2>
                                </th>

                            </tr>

                            <TR>

                                <TD width="50%">

                                    <div>

                                        <TABLE NOBOARDER>
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

                                    </div>

                                    <br>

                                    <p>

                                        <input type="submit" class="btn btn-primary" value="<?php echo TXT_MODIFP; ?>">

                                    </p>
                    </FORM>

                <?php
            }
                ?>

                </div>

                </td>

                <td>

                    <div id="modifmdp">

                        <FORM method="POST" action="">

                            <Table>

                                <TR>

                                    <TD>

                                        <label><?php echo TXT_ANCIENMDP; ?>:</label>

                                    </TD>

                                    <TD>

                                        <input type="text" class="form-control" autocomplete="off" name="mdp_actuel" value="">

                                    </TD>

                                </TR>

                                <TR>

                                    <TD>
                                        <label><?php echo TXT_NOUVEAUMDP; ?>:</label>
                                    </TD>
                                    <TD>
                                        <input type="text" class="form-control" autocomplete="off" name="mdp_nouveau" value="">
                                    </TD>
                                </TR>

                                <TR>
                                    <TD>
                                        <label><?php echo TXT_CONFIRMERMDP; ?> :</label>
                                    </TD>
                                    <TD>
                                        <input type="text" class="form-control" autocomplete="off" name="mdp_confirmer" value="">
                                    </TD>
                                </TR>
                            </TABLE>

                            <br>

                            <p>

                                <input type="submit" class="btn btn-primary" value="<?php echo TXT_MODIFMDP; ?>">

                            </p>

                        </Form>

                        <?php
                        $actuel = $_POST['mdp_actuel'];
                        $mdp = $_POST['mdp_nouveau'];
                        $confirmer = $_POST['mdp_confirmer'];
                        $identifiant = $_SESSION['IdentifiantPe'];

                        $query = "UPDATE personne SET Mot_de_passePe = ?";
                        if (!empty($actuel) && !empty($mdp) && !empty($confirmer)) {
                            $query_pe = "SELECT Mot_de_passePe FROM personne WHERE IdentifiantPe = ?";
                            $req = mysqli_prepare($session, $query_pe);
                            mysqli_stmt_bind_param($req, 's', $identifiant);
                            mysqli_stmt_execute($req);
                            $result = get_result($req);
                            $ligne = array_shift($result);
                            $bd_mdp = $ligne['mot_de_passe'];
                            $actuel = sha1($actuel);
                            if ($actuel == $bd_mdp) {
                                if ($mdp === $confirmer) {
                                    if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/', $mdp)) {

                                        $mdp = sha1($mdp);
                                        $req2 = mysqli_prepare($session, $query);
                                        mysqli_stmt_bind_param($req2, 's', $mdp);
                                        if (mysqli_stmt_execute($req2)) { //modifier avec success
                                            echo ('<p>Votre mot de passe a été modifié</p>');
                                        }
                                    } else //erreur
                                        echo ('<p>Erreur</p>');
                                } else //mot de passe ne sont pas identiques
                                    echo ('<p>Les mots de passe ne sont pas identiques</p>');
                            } else //mot de passe actuel incorrect
                                echo ('<p>Mot de passe incorrect</p>');
                        } else  //manque un champs
                            echo ('<p>Veuillez remplir tous les champs</p>');




                        ?>
                    </div>

                </td>

                </TR>

                </table>

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

                    $reservations = ("SELECT *
                                        FROM emprunt, personne, materiel, calendrier
                                        WHERE emprunt.IdentifiantM = materiel.IdentifiantM
                                        AND emprunt.IdentifiantPe = personne.IdentifiantPe
                                        AND emprunt.IdentifiantCal = calendrier.IdentifiantCal
                                        AND personne.IdentifiantPe = $identifiant;");

                    $result_reservations = mysqli_query($session, $reservations);

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
                    ?>

                </Table>

            </div>

        </main>

</body>

<form>
    <center>
        <input type="button" value="<?php echo TXT_RETOUR; ?>" onclick="history.go(-1)">
    </center>

</form>

</html>
