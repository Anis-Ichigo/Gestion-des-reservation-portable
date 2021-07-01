<?php
require('decide-lang.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Menucss.css" />



</head>

<body>
    

    <div class="main">
        <div class="header" style="width: 100%; height: 18%; margin-bottom: 4%">
            <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="height: 120%;width: 100%">
        </div>
            <table style="text-align: center">
                <tr>
                    <td>

                        <a href="reservation_portable.php">
                            <div> <img src="signe-plus-dans-un-cercle-noir.svg" />
                                <br>
                                <?php if($_SESSION['lang']=='cn'){ ?>
                                <div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo TXT_ACCUEIL_NOUVELLER; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <?php
                                }else{?>
                                <div style="float:left"><?php echo TXT_ACCUEIL_NOUVELLER; ?></div>
                                <?php
                                }?>
                            </div>
                        </a>
                    </td>
                    <td></td>
                    <td>
                        <a href="mes_reservations.php">
                            <div> <img src="rack-serveur-a-trois-niveaux.svg" />
                                </br>
                                <div style="float:right"><?php echo TXT_ACCUEIL_RESERVATION; ?></div>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="profil.php">
                            <div><img src="forme-de-l'utilisateur.svg" />
                                </br>
                                <?php echo TXT_ACCUEIL_PROFIL; ?></div>
                        </a>
                    </td>
                    <td></td>
                    <td>
                        <a href="FAQ.php">
                            <div> <img src="signe-de-question.svg" />
                                </br>
                                <?php echo FAQ; ?></div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>

                        <a href="reglage.php">
                            <div> <img src="silhouette-de-roue-dentee.svg" />
                                </br>
                                <?php echo TXT_ACCUEIL_REGLAGE; ?></div>
                    </td>
                    <td></td>
                    <td>
                        </a>
                        <a href="deconnexion.php">
                            <div><img src="option-de-deconnexion.svg" />
                                </br>
                                <?php echo DECONNEXION; ?></div>
                        </a>
                    </td>
                </tr>
            </table>
    </div>
    
        <!-- partial -->

</body>

</html>