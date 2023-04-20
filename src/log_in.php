<?php
    include("./php/connect.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["email"], $_POST["pseudo"], $_POST["password"]))
            return true;
        return false;
    }

    $db = call_dataBase("localhost", "root", "", "pictio-univ", 3306);

    $login_check = false;

    $email_no_error = true;
    $pseudo_no_error = true;
    $password_no_error = true;

    if (check_POST()) {
        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];

        $request = "SELECT player.id_player, player.pseudo, player.password FROM player
                        INNER JOIN email ON email.id_player = player.id_player
                        WHERE email.mail = \"$email\";";

        $result = @($db->query($request));

        if (($row = $result->fetch_assoc()) !== null) {
            $pseudo_no_error = $row["pseudo"] === $pseudo;
            $password_no_error = password_verify($password, $row["password"]);

            if ($pseudo_no_error && $password_no_error)
                $login_check = true;
                session_start();
                $_SESSION["pseudo"] = $pseudo;
                $_SESSION["email"] = $email;
        }
        else {
            $email_no_error = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/sign_log_in.css">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
    </head>
    <body>
        <header>
            <img src="./images/logo.svg" alt="Logo">
        </header>
        <main>
            <?php
                if (!$login_check) {
                    ?>
                        <section class="login">
                            <form method="POST">
                                <h1>Content de vous revoir !</h1>

                                <hr>

                                <input type="email" name="email" placeholder="prenom.nom@etu.univ-tours.fr" required>
                                <?php if (!$email_no_error) echo "<p class=\"error\">L'email est inconnue !</p>"; ?>
                                <input type="text" name="pseudo" placeholder="Pseudo du joueur" pattern="[a-zA-Z0-9]{1,30}" required>
                                <?php if (!$pseudo_no_error) echo "<p class=\"error\">Le pseudo est incorrect !</p>"; ?>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                                <?php if (!$password_no_error) echo "<p class=\"error\">Le mot de passe est incorrect !</p>"; ?>
                                
                                <hr>
                                
                                <input type="submit" name="submit" value="C'est parti !">
                            </form>
                        </section>
                    <?php
                }
                else {
                    ?> <meta http-equiv="refresh" content="0;url=./"> <?php
                }
            ?>
        </main>
    </body>
</html>

<?php
    close_dataBase($db);
?>