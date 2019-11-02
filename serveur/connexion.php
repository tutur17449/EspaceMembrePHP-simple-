<?php 
session_start();
// Test si l'utilisateur est déjà connecté
if (isset($_SESSION['connect'])){
    header('location: ../index.php');
    exit();
}
// Sinon connexion
require('./config.php');

if(!empty($_POST['email']) && !empty($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = "aq1".sha1($password."1254")."25";     

    $resultat= $dbh -> prepare('SELECT * FROM users WHERE email=?');
    $resultat -> execute(array($email));

    while ($user = $resultat -> fetch()){
        if ($password == $user['pwd_user']){
            // paramètres de la session
            $_SESSION['connect'] = 1;   
            $_SESSION['pseudo'] =  $user['pseudo'];
            // mémorisation des informations à la connexion
            if(isset($_POST['connexion'])){
                setcookie('log', $user['key_user'], time() + 365*24*3600, '/', null, false, true);
            }
            header('location: ./connexion.php?success=1');
            exit();
        }
    }
    header('location: ./connexion.php?error=1');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css">
    <title>Connexion</title>
</head>
<body>
    <h1> Connexion </h1>
    <p> Bienvenue sur le site, pour en voir plus, merci de vous connecter. Si vous n'êtes par encore connecté, <a href="./inscription.php"> inscrivez-vous </a>.</p>
    <?php
        // Contrôle des erreurs
        if (isset($_GET['error'])){
            echo '<p class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Veuillez vérifier vos informations ou vous inscrire. </p>';
        } else if (isset($_GET['success'])){
            echo '<p class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Vous êtes connecté ! </p>';
        }

    ?>    
    <form method="POST" action="connexion.php">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Email :</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="checkbox" name="connexion" checked>
                <label for="connexion">Mémoriser mes identifiants </label>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </div>
    </form>

    <script src="https://kit.fontawesome.com/XXXXX.js"></script>
</body>
</html>
