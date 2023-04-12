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

                $db = call_dataBase("localhost", "root", "", "pictio-univ", 3306);

                $email = $_POST["email"];
                $pseudo = $_POST["pseudo"];
                $password = $_POST["password"];

                $request = "SELECT player.id_player, player.pseudo, player.password FROM player
                                INNER JOIN email ON email.id_player = player.id_player
                                WHERE email.mail = \"$email\";";

                $result = @($db->query($request));
                
                if (($row = $result->fetch_assoc()) !== null) {
                    if (password_verify($password, $row["password"])) {
                        if ($pseudo === $row["pseudo"]) {
                            session_start();
                            $_SESSION["id_player"] = $row["id_player"];
                            $_SESSION["pseudo"] = $row["pseudo"];

                            ?>

                            <meta http-equiv="refresh" content="0;./../">

                            <?php
                        }
                        else {
                            ?>

                            <h1>Connexion échouée</h1>
                            <section class="login">
                                <h1>Connexion échouée :</h1>
                                <h2>Le pseudo est incorrect.</h2>
                                <nav>
                                    <a href="./../html/log_in.html">Retour à la connexion</a>
                                </nav>
                            </section>

                            <?php
                        }
                    }
                    else {
                        ?>

                        <h1>Connexion échouée</h1>
                        <section class="login">
                            <h1>Connexion échouée :</h1>
                            <h2>Le mot de passe est incorrect.</h2>
                            <nav>
                                <a href="./../html/log_in.html">Retour à la connexion</a>
                            </nav>
                        </section>

                        <?php
                    }
                }
                else {
                    ?>

                    <h1>Connexion échouée</h1>
                    <section class="login">
                        <h1>Connexion échouée :</h1>
                        <h2>L'email renseignée n'est pas dans la base de données.</h2>
                        <nav>
                            <a href="./../html/log_in.html">Retour à l'inscription</a>
                        </nav>
                    </section>

                    <?php
                }

                close_dataBase($db);
            ?>
        </main>
    </body>
</html>