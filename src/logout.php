<?php
    session_start();
    session_reset();
    session_unset();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Déconnexion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
    </head>
    <body>
        <meta http-equiv="refresh" content="0;url=./index.php">
    </body>
</html>