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
    echo $_SESSION['pseudo'];
?>
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