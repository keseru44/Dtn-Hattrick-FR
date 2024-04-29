<?php
// Définition de la variable $url avec une valeur par défaut
$url = "https://" . $_SERVER['HTTP_HOST']; // Utilisez une valeur par défaut ou déterminez dynamiquement l'URL de votre site

?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu DTN</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="menu">
        <p>
            <span class="breadvar">Via le menu <a href="addPlayer.php">"Base de données"</a></span> :
        </p>
        <ul>
            <li>Ajouter un joueur</li>
            <li>Tester l'existence d'un joueur dans la base</li>
            <li>Consulter / modifier / ajouter les listes de clubs de la base</li>
        </ul>
    </div>
</body>
</html>
