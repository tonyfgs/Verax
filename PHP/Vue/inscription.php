<?php

session_start();

if (isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
}


else {
    ?>
        <html>
            <body>
                <h1>Formulaire xdddd</h1>
                <form action="/Verax/PHP/DAL/verifInscription.php" method="post">
                    <label for="pseudo">Pseudo :</label><br>
                    <input type="text" id="pseudo" name="pseudo" required><br>
                    <label for="mdp">Mot de passe :</label><br>
                    <input type="password" id="mdp" name="mdp" required><br>
                    <label for="nom">Nom :</label><br>
                    <input type="text" id="nom" name="nom" required><br>
                    <label for="prenom">Prénom :</label><br>
                    <input type="text" id="prenom" name="prenom" required><br>
                    <label for="mail">Adresse email :</label><br>
                    <input type="text" id="mail" name="mail" required><br>
                    <input type="submit" value="Submit">
                </form>
    
    
            </body>
    <?php
    }
    
    ?>