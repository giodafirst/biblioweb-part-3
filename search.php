<?php
require ('config.php');

session_start();

$message='';
$books=[];
$authors=[];
$keyword='';

if(!empty($_GET['keyword'])){
    $keyword = $_GET['keyword'];
}

//Connexion au serveur
$mysqli = @mysqli_connect (HOSTNAME,USERNAME,PASSWORD);
//var_dump($mysqli);
//Connexion à la BD
if($mysqli){
    if(@mysqli_select_db($mysqli,DATABASE)){
        if(empty($keyword)){
            $query = "SELECT * FROM books INNER JOIN authors ON author_id=authors.id";
        } else { 
            $query = "SELECT DISTINCT title,firstname,lastname FROM authors INNER JOIN books ON author_id=authors.id WHERE lastname LIKE '%$keyword%' ORDER BY title ASC";
        } //var_dump($query);
        //Reqûete SQL
        $result = @mysqli_query ($mysqli,$query);
            if($result){
                //Extraction des données
                while (($book = mysqli_fetch_assoc($result)) != null){
                    $books[] = $book;
                //var_dump($book);
                }
                //Libération de la mémoire du résultat
                mysqli_free_result($result);
            } else {
                $message = "Erreur de requête !";
            }       
    } else {
        $message= "Base de données inconnue !";
    }
    //Fermeture de la connexion au serveur
    mysqli_close ($mysqli);
} else {
    $message = "Erreur de connexion !";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Biblioweb</title>
</head>
<body>
    <a href="index.php" id="titre"><h1>Biblioweb</h1></a>
        <div><?= $message ?></div>
            <div>
                <form action="<?= $_SERVER['PHP_SELF']?>" method="get" id="frm">
                <label for="keyword" id="label">Rechercher un auteur</label>
                <input type="text" name="keyword" id="keyword">
                <button>Rechercher</button><br>
                </form>
            </div>
           
            <div class="liste"><?php foreach($books as $book) {?> 
                    <p class="title"><?= $book['title']?></p>
                <?php }?>
                <p class="authors"><strong><?= $book['firstname']?> <?=$book['lastname']?></strong></p>
            </div>     
</body>
</html>
