<?php
require('config.php');

$message='';
$books=[];

if(isset($_POST['modifier']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['nationality'])){
    //Connexion au serveur
$mysqli = @mysqli_connect (HOSTNAME,USERNAME,PASSWORD);
//var_dump($mysqli);
//Connexion à la BD

    if($mysqli){
        if(@mysqli_select_db($mysqli,DATABASE)){
            $lastname = @mysqli_real_escape_string($mysqli, $_POST['lastname']); //var_dump($lastname);die;
            $firstname = @mysqli_real_escape_string($mysqli, $_POST['firstname']); //var_dump($firstname);die;
            $nationality = @mysqli_real_escape_string($mysqli,$_POST['nationality']); //var_dump($nationality);die;
                $query = "INSERT INTO authors (lastname,firstname,nationality) VALUES ('$lastname','$firstname','$nationality')"; //var_dump($query);die;
            
            //Reqûete SQL
            $result = @mysqli_query ($mysqli,$query);
                if($result && mysqli_affected_rows($mysqli)>0){
                    $message = "Insertion réussie !";
                } else {
                    $message = "Une erreur est survenue lors de l'insertion !";
                }       
        } else {
        $message= "Base de données inconnue !";
        }
        //Fermeture de la connexion au serveur
        mysqli_close ($mysqli);
    }else{
        $message = "Erreur de connexion";
    }
}else{
    $message = "Veuillez remplir les champs !";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'auteur</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF']?>" method="post" id="modify">
        <input type="hidden" name="ref">
        <label for="lastname">Nom</label>
        <input type="text" name="lastname"><br>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname"><br>
        <label for="nationality">Nationalité</label>
        <input type="text" name="nationality"><br>
        <button name="modifier">Ajouter un auteur</button>
    </form>
    <div>
        <?= $message ?>
    </div>
</body>
</html>