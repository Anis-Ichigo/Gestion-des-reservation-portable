<?php
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

        $mdp_hash = sha1($psw);


        $login="SELECT IdentifiantPe, NomPe, PrenomPe, EmailPe, Mot_de_passePe, TelPe, Statut, Formation 
        FROM personne
        WHERE EmailPe= ? AND Mot_de_passePe = ?";
        $stmt=mysqli_prepare($session,$login);
        mysqli_stmt_bind_param($stmt,"ss",$user,$mdp_hash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$identifiant,$nom,$prenom,$gooduser,$goodpsw,$tel,$statut, $formation);
        while (mysqli_stmt_fetch($stmt)){
            echo $gooduser ;
            echo $goodpsw;
        }

        if($user!=$gooduser or $mdp_hash!=$goodpsw){
            $lange= $_POST['lang'];
            echo "<h2>Mauvais login </h2><br>
                  <h4>Vérifiez votre identifiant et votre mot de passe.</h4><br>
                  <button><a href='index.html'>Merci de recommencer.</a></button><br>";
            echo "Ou <br>
                     <form action='Page_Inscription.php' method='post' >
                        <input type='hidden' name='lang' value=$lange>
                        <button type='submit' name='creer_compte' class='compte'>Créer un compte.</button>
                     </form>
                    ";
        }else{
            session_start();
            $_SESSION['user']=$gooduser;
            $_SESSION['nom']="$prenom $nom";
            $_SESSION['identifiant']=$identifiant;
            $_SESSION['psw']=$goodpsw;
            $_SESSION['tel']=$tel;
            $_SESSION['statut']=$statut;
            $_SESSION['formation']=$formation;

            header("Location: menu3.php");
        }



        $_SESSION['lang']=$_POST['lang'];
        //echo $_SESSION['lang'];


        mysqli_close($session);
        ?>

    </div>
</div>
<!-- partial -->
<script  src="./script.js"></script>



</body>

</html>