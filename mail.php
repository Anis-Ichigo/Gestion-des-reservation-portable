<?php
require('Connexion_BD.php');
mysqli_set_charset($session, "utf8");

function codestr(){
    $arr=array_merge(range('a','b'),range('A','B'),range('0','9'));
    shuffle($arr);
    $arr=array_flip($arr);
    $arr=array_rand($arr,6);
    $res='';
    foreach ($arr as $v){
        $res.=$v;
    }
    return $res;
}

$code=codestr();


if(isset($_POST['envoyer'])){
    $user=$_POST["user"];

    $destinataire =$user ;
    $objet = "confirmer";
    $message = $code;
    $headers = "From: pret.responsable@ut-capitole.fr" . "\r\n" .
        "Reply-To: pret.responsable@ut-capitole.fr" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail("$destinataire", $objet, $message, $headers);

    $mdp=sha1($code);


    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>mail</title>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="connexion.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div class="main">

        <div class="menu" >
            <div class="form-group" align="center" >
                <img alt="Logo UT1" class="img_logo" src="Bandeau.png" style="width: 100%; margin-top: 1%">
                <form action="mail_con.php" method="post">
                    <input type="hidden" name="mdp" value="<?php echo $mdp; ?>">
                    <input type="hidden" name="user" value="<?php echo $destinataire; ?>">
                    <table>

                            <tr>
                                <label for="code">Nouveau mot de passe</label>
                            </tr>
                        <br>
                            <tr>
                                <label for="code">(le code dans l'email)</label>
                            </tr>

                        <br>
                            <tr>
                                <input type="password" class="form-control"  name="mdp_nouveau" placeholder=" ******" >
                            </tr>

                    </table>

                    <button type="submit" class="btn btn-primary mb-3"  name="confirmer" style="font-size: 1.25em;">
                        Confirmer
                    </button>
                </form>


            </div>
        </div>
        <!-- partial -->
        <script  src="./script.js"></script>

    </body>

    </html>


    <?php
}else{
    echo 'no';
}





?>

