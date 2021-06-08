<?php
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");
require('decide-lang.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>reservation</title>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Styletest.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</head>

<body>
    <?php

    // Lisa inscription
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
                } else echo MDP_DIFFERENT;
            } else echo MDP_COURT;
        } else echo MDP_CHAMPS;
    }
    ?>

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

    <!--<div style="float: right">
        <?php // echo $Prenom . " " . $Nom;
        ?>
        <a type="button" class="btn btn-sm btn-secondary" href="deconnexion.php">Se déconnecter</a>
    </div>
    <br><br> -->
    <div class="mycharts-heading">

        <div class="element-head"> <?php echo $Nom; ?> <?php echo $Prenom; ?><button type="button" id="b1" class="btn btn-default btn-sm"><i class="fi-rr-sign-out"></i></button></div>

    </div>
    <form method="POST" action="" id='form'>

        <h2 class="text-center"><?php echo TXT_ACCUEIL_NOUVELLER; ?></h2>

        <table>
            <!--Materiel, comment recuperer les donnees dans select-->
            <tr>
                <td>
                    <label><?php echo TXT_DEMANDE_CONCERNE; ?> :</label>
                </td>
                <td>
                    <SELECT name="categorie" size=" 1 " required>
                        <?php
                        $res = mysqli_query($session, "SELECT CategorieM FROM materiel WHERE EtatM LIKE 'Dispo' AND StatutM LIKE 'Existant' GROUP BY CategorieM");
                        while ($tab = mysqli_fetch_assoc($res)) {
                            $cat = addslashes($tab["CategorieM"]);
                            echo "<Option> $cat </Option>";
                        }
                        ?>
                    </SELECT> (*)
                </td>
            </tr>
            <!--Date de retour-->
            <tr>
                <td>
                    <?php echo TXT_CHOIX_RETOUR; ?> :
                </td>
                <td>
                    <input type="date" class="form-control" name="DateRetour" placeholder="dd-mm-yyyy" pattern="^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$" required>
                </td>
                <td>
                    (*)
                </td>
                </div>
            </tr>
        </table>
        <br>

        <!--les creneaux-->
        <!--input sans icon, button avec icon mais toujours submit automatiquement-->
        <input type="button" class="accordion" value="<?php
                                                        $premierJour = strftime("%d/%m/%Y", strtotime("monday"));
                                                        echo TXT_LUNDI . " $premierJour";
                                                        ?>">

        <div class="panel">
            <table class="table">
                <?php
                $sql = "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible'";
                $res = mysqli_query($session, $sql);
                $num = mysqli_num_rows($res);

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
        <!--
        <div class="panel">
            <p>
               <?php
                /* un creneau dans chaque ligne
                $res = mysqli_query($session, "SELECT * FROM calendrier WHERE JourCal='Lundi' AND EtatCal = 'Disponible'");
                while ($tab = mysqli_fetch_assoc($res)) {
                    $horaire = $tab["HoraireCal"];

                    echo "<Table class='table table-striped table-hover text-center'> <TR> <TD><input type='submit' class='btn btn-primary' name='horaire_lundi' value='$horaire'> </td></TR> </table>";
                }
        */
                ?>

            </p>
        </div>
        -->

        <input type="button" class="accordion" value="<?php
                                                        $premierJour = strftime("%d/%m/%Y", strtotime("tuesday"));
                                                        echo TXT_MARDI . " $premierJour";
                                                        ?>">

        <div class="panel">
            <table class="table">
                <?php
                $sql = "SELECT * FROM calendrier WHERE JourCal='Mardi' AND EtatCal = 'Disponible'";
                $res = mysqli_query($session, $sql);
                $num = mysqli_num_rows($res);

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


        <input type="button" class="accordion" value="<?php
                                                        $premierJour = strftime("%d/%m/%Y", strtotime("wednesday"));
                                                        echo TXT_MERCREDI . " $premierJour";
                                                        ?>">

        <div class="panel">
            <table class="table">

                <?php
                $sql = "SELECT * FROM calendrier WHERE JourCal='Mercredi' AND EtatCal = 'Disponible'";
                $res = mysqli_query($session, $sql);
                $num = mysqli_num_rows($res);

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


        <input type="button" class="accordion" value="<?php
                                                        $premierJour = strftime("%d/%m/%Y", strtotime("thursday"));
                                                        echo TXT_JEUDI . " $premierJour";
                                                        ?>">

        <div class="panel">
            <table class="table">

                <?php
                $sql = "SELECT * FROM calendrier WHERE JourCal='Jeudi' AND EtatCal = 'Disponible'";
                $res = mysqli_query($session, $sql);
                $num = mysqli_num_rows($res);

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

        <input type="button" class="accordion" value="<?php
                                                        $premierJour = strftime("%d/%m/%Y", strtotime("friday"));
                                                        echo TXT_VENDREDI . " $premierJour";
                                                        ?>">


        <div class="panel">
            <table class="table">

                <?php
                $sql = "SELECT * FROM calendrier WHERE JourCal='Vendredi' AND EtatCal = 'Disponible'";
                $res = mysqli_query($session, $sql);
                $num = mysqli_num_rows($res);

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
            var myModal = document.getElementById('exampleModal')
            var myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', function() {
                myInput.focus()
            })
        </script>

        <!-- Accordion -->
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

    </form>

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
        $categorieM = $_POST['categorie'];

        $id_materiel = ("SELECT * FROM materiel WHERE EtatM LIKE 'Dispo' AND StatutM LIKE 'Existant' AND CategorieM = '$categorieM' LIMIT 1");
        $result_id_materiel = mysqli_query($session, $id_materiel);
        foreach ($result_id_materiel as $materiel) {
            $IdentifiantM = $materiel['IdentifiantM'];
        }


        $id_creneau = ("SELECT * FROM calendrier WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
        $result_id_creneau = mysqli_query($session, $id_creneau);
        foreach ($result_id_creneau as $creneau) {
            $IdentifiantCal = $creneau['IdentifiantCal'];
        }

    ?>
        <!-- Modal -->

        <form action="" method="POST">
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
                                    <input type="text" class="form-control-plaintext" name="categorieM" value="<?php echo $categorieM; ?>" readonly>
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
            $dateRetour = $_POST['DateRetour'];

            $horaire = $_POST['horaire'];
            $jour = $_POST['jour'];
            $date_Emprunt = $_POST['date_emprunt'];
            $dateEmprunt = date('Y-d-m', strtotime($date_Emprunt));

            $categorie = $_POST['categorieM'];
            $identifiantM = $_POST['IdentifiantM'];
            $identifiantCal = $_POST['IdentifiantCal'];

            $identifiantPe = $identifiant;



            $emprunter = ("UPDATE calendrier SET EtatCal = 'Indisponible' WHERE calendrier.JourCal LIKE '$jour' AND calendrier.HoraireCal = '$horaire'");
            $result_emprunter = mysqli_query($session, $emprunter);

            $etat_materiel = ("UPDATE materiel SET EtatM = 'Non Dispo' WHERE IdentifiantM = '$identifiantM'");
            $result_etat_materiel = mysqli_query($session, $etat_materiel);


            $insert_rdv = ("INSERT INTO `emprunt`(`DateEmprunt`, `DateRetour`, `DateProlongation`, `Motif`, `IdentifiantM`, `IdentifiantPe`, `IdentifiantCal`)
                    VALUES ('$dateEmprunt', '$dateRetour', NULL, 'Acquisition', '$identifiantM', '$identifiantPe', '$identifiantCal')");
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
                                <input type="button" class="btn btn-primary" onclick="history.go(-1)" value="<?php echo TXT_OK; ?> ">
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
            <a href="menu2.php" type="button" class="btn btn-secondary">Retour</a>
        </div>

</body>

</html>