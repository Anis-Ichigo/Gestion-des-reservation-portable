<?php
session_start();
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="connexion.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<div class="main">

    <div class="menu">
        <div class="form-group" align="center">
        <?php
        $user=$_POST["user"];
        $psw=$_POST["psw"];

        $login="SELECT IdentifiantPe, NomPe, PrenomPe, EmailPe, Mot_de_passePe, TelPe, Statut, Formation 
        FROM personne
        WHERE IdentifiantPe= ? AND Mot_de_passePe = ?";
        $stmt=mysqli_prepare($session,$login);
        mysqli_stmt_bind_param($stmt,"is",$user,$psw);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$gooduser,$nom,$prenom,$email,$goodpsw,$tel,$statut, $formation);
        while (mysqli_stmt_fetch($stmt)){
            echo $gooduser ;
            echo $goodpsw;
        }

        if($user!=$gooduser or $psw!=$goodpsw){
            echo "<h2>Mauvais login </h2><br>
                  <h4>Vérifiez votre identifiant et votre mot de passe.</h4><br>
                   <a href='connexion.html'>Merci de recommencer.</a><br>";
            echo "Ou <br><a href='Page_Inscription.php'>Créer un compte.</a>";
        }else{
            $_SESSION['user']=$gooduser;
            $_SESSION['nom']="$prenom $nom";
            $_SESSION['mail']=$email;
            $_SESSION['psw']=$goodpsw;
            $_SESSION['tel']=$tel;
            $_SESSION['statut']=$statut;
            $_SESSION['formation']=$formation;

            header("Location: menu2.html");
        }
        mysqli_close($session);
        ?>

    </div>
</div>
<!-- partial -->
<script  src="./script.js"></script>



</body>

</html>