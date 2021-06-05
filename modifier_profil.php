<?php

session_start();

require('Connexion_BD.php');

mysqli_set_charset($session, "utf8");

include('decide-lang.php');
?>

<!DOCTYPE html>

<html>



<head>

    <title>Profil</title>

    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <link rel="stylesheet" href="Style.css" />

    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>

    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">

</head>



<body>

    <main>





        <div class="contenu">

            <h1><?php echo TXT_ACCUEIL_PROFIL;?></h1>

            <H2><?php echo TXT_INFORMATION ;?> </h2>



            <?php

            //$identifiant = $_SESSION['identifiant'];

            $identifiant = '22508753';



            ?>



            <FORM method="POST" action="profil.php">

                <div class="form-group row">

                    <TABLE NOBOARDER>

                        <TR>

                            <TD>

                                <label><?php echo TXT_PRENOM;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_PrenomPe" value="<?php echo $_POST["PrenomPe"]; ?>">

                            </TD>

                        </TR>

                        <TR>

                            <TD>

                                <label><?php echo TXT_NOM;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_NomPe" value="<?php echo $_POST['NomPe']; ?>">

                            </TD>

                        </TR>

                        <TR>

                            <TD>

                                <label><?php echo TXT_EMAIL ;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_EmailPe" value="<?php echo $_POST['EmailPe']; ?>">

                            </TD>

                        </TR>

                        <TR>

                            <TD>

                                <label><?php echo TXT_ADRESSE;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_AdressePe" value="<?php echo $_POST['AdressePe']; ?>">

                            </TD>

                        </TR>



                        <TR>

                            <TD>

                                <label><?php echo TXT_TEL;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_TelPe" value="<?php echo $_POST['TelPe']; ?>" >

                            </TD>

                        </TR>



                        <TR>

                            <TD>

                                <label><?php echo TXT_IDENTITE;?> :</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_Statut" value="<?php echo $_POST['Statut']; ?>">

                            </TD>

                        </TR>



                        <TR>

                            <TD>

                                <label><?php echo TXT_FORMATION;?>:</label>

                            </TD>

                            <TD>

                                <input type="text" class="form-control" autocomplete="off" name="modif_Formation" value="<?php echo $_POST['Formation']; ?>">

                            </TD>

                        </TR>

                    </TABLE>

                </div>





                <br>

                <p>

                    <input type="submit" name="modifier" class="btn btn-primary" value="<?php echo TXT_MODIFIER;?>">

                    <input type = "button" value = "<?php echo TXT_RETOUR ;?>"  onclick = "history.go(-1)">
                </p>

            </FORM>



        </div>

    </main>

</body>



</html>

