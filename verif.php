<?php
require ('config.php');

session_start();

function verification($nom,$pass){
    if($mysqli= mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE)){ 
        $nom = mysqli_real_escape_string($mysqli,$nom);

        $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `login`='$nom'"); //var_dump($result);die;

        if($result){
            $user = mysqli_fetch_assoc($result); //var_dump($user);die;

            mysqli_free_result($result);

            if(password_verify($pass,$user['password'])){
                mysqli_close($mysqli);
                return true;
            }
        }
        mysqli_close($mysqli);
        return false;
    }
}
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])){
    $pseudo = $_POST['pseudo']; //var_dump($pseudo);
    $motdepasse = $_POST['motdepasse']; //var_dump($motdepasse);die;

    if(verification($pseudo,$motdepasse)){
        $_SESSION['pseudo'] = $pseudo;
        $message = 'Vous êtes correctement identifié.';
        $message .= '<a href="admin.php"> Allez à l\'espacce admin. </a>';
        $message .= '<a href="membre.php"> Allez à l\'espace membre. </a>';
    }else{
        $message = 'Login et/ou mot de passe incorrect.';
        $message .= '<a href="auth.php">Retour</a>';
    }
}else{
    $message ='Le login ou le mot de passe est vide.';
    $message .='<a href="auth.php">Retour</a>';
}

?>
<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="utf-8">
        <title>Identification</title>
    </head>
    <body>
        <p><?= $message ?></p>
    </body>
</html>