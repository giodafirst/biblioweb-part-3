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
            <form action="verif.php" method="post" name="connexion">
                <div>
                     <label for="pseudo">Nom d'utilisateur :</label>
                <input type="text" id="pseudo" name="pseudo">
                </div>
                <div>
                    <label for="motdepasse">Mot de passe :</label>
                <input type="password" id="motdepasse" name="motdepasse">
                </div>
                <div>
                    <button id="btLogin" name="btLogin">Se connecter</button>
                </div>
            </form>   
</body>
</html>