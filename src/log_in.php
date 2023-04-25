<?php
    include("./php/log_in.php");
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
                                <?php if (!$email_no_error) echo "<p class=\"error\">L'email est inconnu !</p>"; ?>
                                <input type="text" name="pseudo" placeholder="Pseudo du joueur" pattern="[a-zA-Z0-9]{1,30}" required>
                                <?php if (!$pseudo_no_error) echo "<p class=\"error\">Le pseudo est incorrect !</p>"; ?>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                                <?php if (!$password_no_error) echo "<p class=\"error\">Le mot de passe est incorrect !</p>"; ?>
                                
                                <hr>
                                
                                <input type="submit" name="submit" value="C'est parti !">
                            </form>

                            <a href="./index.php">Retour à l'accueil</a>
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