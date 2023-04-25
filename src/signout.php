<?php
    include("./php/connect_check.php");
    include("./php/force_unaccess.php");

    include("./php/connect.php");
    include("./php/connect_fast.php");

    $id_player = $_SESSION["id"];

    $request = "SELECT email.id_mail FROM email
                    WHERE email.id_player = $id_player;";
    $result = @($db->query($request));

    while (($row = $result->fetch_assoc()) !== null) {
        $id_mail = $row["id_mail"];
        $request = "DELETE FROM email WHERE email.id_mail = $id_mail;";
        @($db->query($request));
    }

    $request = "DELETE FROM player WHERE player.id_player = $id_player;";
    @($db->query($request));

    session_reset();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Désinscription</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
    </head>
    <body>
        <meta http-equiv="refresh" content="0;url=./index.php">
    </body>
</html>

<?php
    close_dataBase($db);
?>