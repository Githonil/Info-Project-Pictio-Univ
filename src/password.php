<?php
    include("./php/connect_check.php");
    include("./php/force_unaccess.php");
    include("./php/password.php");
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Gestion des mots de passe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link rel="stylesheet" type="text/css" href="./styles/password.css">
    </head>
    <body>
        <header>
            <img src="./images/logo.svg" alt="Logo">
        </header>
        <main>
            <section class="mdp">
                <form method="POST">
                    <h1>Gestion des mots de passe</h1>

                    <hr>

                    <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
                    <input type="password" name="confirm_new_password" placeholder="Confirmer le nouveau mot de passe" required>
                    <?php if (!$confirm_password_no_error) echo "<p class=\"error\">Les mots de passes ne sont pas identiques !</p>"; ?>

                    <input type="password" name="password" placeholder="Ancien mot de passe" required>
                    <?php if (!$password_no_error) echo "<p class=\"error\">L'ancien mot de passe est incorrect !</p>"; ?>

                    <?php if ($modif_check) echo "<p class=\"success\">Le mot de passe a été changé !</p>"; ?>

                    <input type="submit" name="submit" value="Modifier">

                </form>

                <a href="./account.php">Retour au compte</a>
            </section>
        </main>
    </body>
</html>

<?php
    close_dataBase($db);
?>