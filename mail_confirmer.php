<?php
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");

$user=$_POST['user'];
$mdp=$_POST['mdp'];
$mdp_saisir=sha1($_POST['mdp_nouveau']);

    if (isset($_POST['confirmer'])){
        if($mdp_saisir== $mdp ){


            $query = "UPDATE personne SET Mot_de_passePe = ? WHERE IdentifiantPe = '$user'";
            $result = mysqli_prepare($session, $query);
            mysqli_stmt_bind_param($result, 's', $mdp);
            mysqli_stmt_execute($result);

            header("Location:Index.html");
        }else{
            echo 'merci de recommencer';
        }
    }
    ?>



