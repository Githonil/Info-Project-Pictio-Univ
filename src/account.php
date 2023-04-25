<?php
	include("./php/connect_check.php");
    include("./php/force_unaccess.php");
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Compte de <?= $_SESSION["pseudo"] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link rel="stylesheet" type="text/css" href="./styles/account.css">
    </head>
    <body>
        <header>
            <img src="./images/logo.svg" alt="Logo">
        </header>
        <main>
            <div class="account">
                <nav class="button_profile">
                    <a href="#">Dessins enregistrer</a>
                    <a href="./email.php">Gestion des emails</a>
                    <a href="./password.php">Gestion du mot de passe</a>
                </nav>

                <div class="modification">
                    <form method="POST">
                        <label>
                            <input type="text" name="pseudo" placeholder="Pseudo du joueur" pattern="[a-zA-Z0-9]{1,30}">
                        </label>
                        <div class="custom_character">
                            <img src="./images/base_character.svg" alt="character">
                            <button class="left_up"></button>
                            <button class="left_down"></button>
                            <button class="right_up"></button>
                            <button class="right_down"></button>
                        </div>

                        <input type="submit" name="submit" value="Changer">
                    </form>
                </div>

                <div class="out_box">
                    <div class="recap">
                        <img src="./images/base_character.svg" alt="character">
                        <h2><?= $_SESSION["pseudo"] ?></h2>
                    </div>
                    <a href="./logout.php">Déconnexion</a>
                    <button onclick="spawn_popup()">Supression du compte</button>
                </div>

                <div class="reception">
                    <span class="design"></span>
                    <a href="./index.php">Accueil</a>
                </div>
            </div>
        </main>
        <section class="hidden" id="popup">
            <h1>Êtes-vous sûr de supprimer votre compte de manière définitive ?</h1>
            <nav>
                <button onclick="go_signout()">Oui</button>
                <button onclick="despawn_popup()">Non</button>
            </nav>
        </section>

        <script src="./scripts/signout.js"></script>
    </body>
</html>