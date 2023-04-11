<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link rel="shortcut icon" type="image/svg" href="./../images/logo.svg"/>
        <link rel="stylesheet" type="text/css" href="./../styles/sign_in.css">
        <link rel="stylesheet" type="text/css" href="./../styles/style.css">
    </head>
    <body>
        <header>
            <img src="./../images/logo.svg" alt="Logo">
        </header>
        <main>
            <?php
                include("./connect.php");

                $email = $_POST["email"];
                $pseudo = $_POST["pseudo"];
                $password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];

                $db = call_dataBase("localhost", "pictio_univ", 3306);

                $request = "SELECT email.mail FROM email
                                WHERE email.mail = \"$email\";";
                $result = @($db->query($request));

                if ($password === $confirm_password && $result->fetch_assoc() === null) {
                    ?>
                    <section class="signin">
                        <h1>Inscription réussie !</h1>
                        <nav>
                            <a href="./../index.html">Retour au menu</a>
                        </nav>
                    </section>
                    <?php

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $request = "INSERT INTO player (pseudo, password) VALUE (\"$pseudo\", \"$passwordHash\");";
                    @($db->query($request));

                    $request = "SELECT MAX(player.id_player) FROM player;";
                    $result = @($db->query($request));

                    $id = ($result->fetch_assoc())["MAX(player.id_player)"];

                    $request = "INSERT INTO email (mail, id_player) VALUE (\"$email\", $id);";
                    @($db->query($request));
                }
                else {
                    ?>
                    <section class="signin">
                        <h1>Inscription échouée :</h1>
                        <h2>La confirmation du mot de passe est incorrecte ou l'email a déjà été enregistrer.</h2>
                        <nav>
                            <a href="./../sign_in.html">Retour à l'inscription</a>
                        </nav>
                    </section>
                    <?php
                }

                close_dataBase($db);
            ?>
        </main>
    </body>
</html>