<!DOCTYPE html>
<html>
    <body>
<?php

session_start();

if (isset($_SESSION['pseudo'])) {
    header('Location: connexion.php');
}


else {
    ?>
        <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link rel="stylesheet" href="../assets/css/Connexion.css">
    
    </head>
    
    <div class="bg">
        <!-- Bouton de retour -->
        <a href="javascript:history.back()" class="back-button">Retour</a>
    
        <div class="login-container">
            <div class="logo">Verax</div> 
            <form action="/Verax/PHP/DAL/verifInscription.php" method="post">
                <div class="input-group">
                    <input type="text" id="pseudo" placeholder="Nom d'utilisateur" name="pseudo" required>
                </div>
            <div class="input-group">
                <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" required>
            </div>
            <div class="input-group">
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
            </div>
            <div class="input-group">
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
            </div>
            <div class="input-group">
                <input type="text" id="mail" name="mail" placeholder="Mail" required>
            </div>
            
            <button class="btn" type="submit">S'inscrire</button> <br/>
            </form>
        </div>
    </div>
                
    
    
    
            
    <?php
    }
    
    ?>
    
        </body>
    </html>