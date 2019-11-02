<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
    <title>Accueil</title>
</head>
<body>
    <h1> Accueil </h1>
    <?php 
        // Test si l'utilisateur est déjà connecté
    if (isset($_SESSION['connect'])){
        echo '<p style="text-align:center;"> Bonjour '.$_SESSION['pseudo'].'!<br>
              <a href="./serveur/deconnexion.php"> Se déconnecter </a>
              </p>';
    } else { ?>
    <p> Bienvenue sur le site, pour en voir plus, merci de vous <a href="./serveur/inscription.php"> inscrire </a>. Sinon, <a href="./serveur/connexion.php"> connectez-vous </a>.</p>
    <?php 
        }
    ?>
    <script src="https://kit.fontawesome.com/XXXXX.js"></script>
</body>
</html>
