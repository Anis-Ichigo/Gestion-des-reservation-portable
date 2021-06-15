<?php
require('decide-lang.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>FAQ</title>
    <meta charset="utf-8" />
    <script src="https://kit.fontawesome.com/27e9b6ce5f.js" crossorigin="anonymous"></script>
    <link href="uicons-regular-rounded/uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">

    <link href="Style_FAQ.css" type="text/css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>

<body>
    <div class="header">
        <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="width: 100%; margin-top: 1%;">
    </div>
    <div class="contenu">
        <h2 class="text-center"> <?php echo TXT_ACCUEIL_FAQ; ?> </h2>
        <section class="faq">
            <strong><?php echo TXT_QUESTION1; ?></strong>
            <p align="justify"> <?php echo TXT_REPONSE1_A; ?> <a href="reservation_portable.php"><i>"<?php echo TXT_REPONSE1_B; ?>"</i></a><?php echo TXT_REPONSE1_C; ?>
            </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION2; ?></strong>
            <p align="justify"><?php echo TXT_REPONSE2; ?> </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION3; ?></strong>
            <p align="justify"><?php echo TXT_REPONSE3_A; ?>
                <i>"<?php echo TXT_REPONSE3_B; ?>"</i> <?php echo TXT_REPONSE3_C; ?>
            </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION4; ?></strong>
            <p> <?php echo TXT_REPONSE4_A; ?>
                <a href="mes_reservations.php"> <i>"<?php echo TXT_REPONSE4_B; ?>"</i></a>
                <?php echo TXT_REPONSE4_C; ?>
            </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION5; ?></strong>
            <p> <?php echo TXT_REPONSE5_A; ?> <a href="AC.php"><?php echo TXT_REPONSE5_B; ?></a>. </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION6; ?></strong>
            <p> <?php echo TXT_REPONSE6; ?> <a href="CGU.php"><?php echo TXT_REPONSE5_B; ?></a>. </p>
        </section>
        <section class="faq">
            <strong><?php echo TXT_QUESTION7; ?></strong>
            <p> <?php echo TXT_REPONSE7; ?><a href="mes_reservations.php"> <?php echo TXT_REPONSE5_B; ?></a>.
            </p>
        </section>
    </div>


    <div class="text-center">
        <a href="menu3.php" type="button" class="btn btn-secondary mb-3" style="text-transform: uppercase;"><?php echo TXT_MENU; ?></a>

    </div>

    <!--
    <footer style="text-align: center; font-size: 1.5em; bottom:0; position:absolute; width:100%; background-color: #ffc0cb;">
        Site réalisé par Marine CABIROL - Haoyang YU - Lisa DE SMET - Anis MANA - Antoine LAVIGNE
    </footer>
    -->
</body>


</html>