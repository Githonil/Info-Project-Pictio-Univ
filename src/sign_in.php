<?php
    include("./php/connect.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["email"], $_POST["pseudo"], $_POST["password"], $_POST["confirm_password"]))
            return true;
        return false;
    }

    $db = call_database("localhost", "root", "", "pictio-univ", 3306);

    $signin_check = false;

    $password_no_error = true;
    $email_no_error = true;

    if (check_POST()) {
        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        $request = "SELECT email.mail FROM email
                        WHERE email.mail = \"$email\";";
        $result = @($db->query($request));

        $password_no_error = $password === $confirm_password;
        $email_no_error = $result->fetch_assoc() === null;

        if ($password_no_error && $email_no_error) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $request = "INSERT INTO player (pseudo, password) VALUE (\"$pseudo\", \"$passwordHash\");";
            @($db->query($request));

            $request = "SELECT MAX(player.id_player) FROM player;";
            $result = @($db->query($request));

            $id = ($result->fetch_assoc())["MAX(player.id_player)"];

            $request = "INSERT INTO email (mail, id_player) VALUE (\"$email\", $id);";
            @($db->query($request));

            $signin_check = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inscription</title>
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/sign_log_in.css">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
    </head>
    <body>
        <header>
            <img src="./images/logo.svg" alt="Logo">
        </header>
        <main>
            <section class="signin">
                <?php
                    if (!$signin_check) {
                        ?>
                            <form method="POST">
                                <h1>Inscrivez-vous en quelque clics !</h1>

                                <hr>

                                <input type="email" name="email" placeholder="prenom.nom@etu.univ-tours.fr" required>
                                <?php if (!$email_no_error) echo "<p class=\"error\">L'email a déjà été enregistrer !</p>"; ?>
                                <input type="text" name="pseudo" placeholder="Pseudo du joueur" pattern="[a-zA-Z0-9]{1,30}" required>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                                <input type="password" name="confirm_password" placeholder="Confirmez le mot de passe" required>
                                <?php if (!$password_no_error) echo "<p class=\"error\">Les mots de passes ne sont pas identiques !</p>"; ?>
                                
                                <hr>
                                
                                <input type="submit" name="submit" value="C'est parti !">
                            </form>
                        <?php
                    }
                    else {
                        ?>
                            <h1>Inscription réussie !</h1>
                            <nav>
                                <a href="./index.html">Retour au menu</a>
                            </nav>
                        <?php
                    }
                ?>
            </section>
        </main>
    </body>
</html>

<?php
    close_dataBase($db);
?>