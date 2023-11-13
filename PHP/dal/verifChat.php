
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Chat Messages</title>
</head>
<body>

<h1>Messages du Chat</h1>
<?php

require 'Connection.php';
require 'ChatGateway.php';


try {
    $username = "tonyfgs";
    $password = "";
    $dsn = "pgsql:host=localhost;dbname=dbVerax";
    $con = new Connection($dsn, $username, $password);
    $chatGateway = new ChatGateway($con);

    // Afficher les derniers messages
    $messages = $chatGateway->getLastNMessages(10);
    if (!empty($messages)) {
        echo "<h2>Derniers messages</h2>";
        echo "<ul>";
        foreach ($messages as $message) {
            echo "<li>";
            echo "<strong>Pseudo:</strong> " . htmlspecialchars($message['pseudo']) . "<br>";
            echo "<strong>Message:</strong> " . htmlspecialchars($message['content']) . "<br>";
            echo "<strong>Date:</strong> " . $message['timestamp'];
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun message récent à afficher.</p>";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

?>

</body>
</html>