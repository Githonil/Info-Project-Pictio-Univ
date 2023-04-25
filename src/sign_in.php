<?php
    include("./php/sign_in.php");
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

                            <a href="./index.php">Retour à l'accueil</a>
                        <?php
                    }
                    else {
                        ?>
                            <h1>Inscription réussie !</h1>
                            <nav>
                                <a href="./index.php">Retour au menu</a>
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