<!DOCTYPE html>
<html>
    <body>
<?php

session_start();

if (isset($_SESSION['mdp'])) {
    echo "Connexion réussie !<br/>";
    echo $_SESSION['pseudo'];
    ?>
    <a href="deconnexion.php">Se déconnecter</a>
<?php
    
}

else {
?>
    <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/Connexion.css">

</head>

<div class="bg">
    <!-- Bouton de retour -->
    <a href="javascript:history.back()" class="back-button">Retour</a>

    <div class="login-container">
        <div class="logo">Verax</div> 
        <form action="/Verax/PHP/DAL/verifConnexion.php" method="post">
            <div class="input-group">
                <input type="text" id="pseudo" placeholder="Nom d'utilisateur" name="pseudo" required>
            </div>
        <div class="input-group">
            <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" required>
        </div>
        <button class="btn" type="submit">Se connecter</button>
        </form>
        <a href="#">Mot de passe oublié ?</a>
    </div>
</div>

            <h1>Formulaire xdddd</h1>
            <form action="/Verax/PHP/DAL/verifConnexion.php" method="post">
                <label for="pseudo">Pseudo :</label><br>
                <input type="text" id="pseudo" name="pseudo" required><br>
                <label for="mdp">Mot de passe :</label><br>
                <input type="password" id="mdp" name="mdp" required><br>
                <input type="submit" value="Submit">
            </form>
            



        
<?php
}

?>

    </body>
</html>