<?php
	include("./php/account.php");
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Compte de <?= $_SESSION["pseudo"]; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link rel="stylesheet" type="text/css" href="./styles/account.css">
    </head>
    <body>
        <header>
            <a href="./index.php"><img src="./images/logo.svg" alt="Logo"></a>
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
                            <img src="./images/base_character.svg" alt="character" id="character">
                            <input type="hidden" name="dataImg" id="dataImg">
                            <input type="button" class="left_up" value="<">
                            <input type="button" class="left_down" value="<" onclick="removeBody()">
                            <input type="button" class="right_up" value=">">
                            <input type="button" class="right_down" value=">" onclick="addBody()">
                        </div>

                        <input type="submit" name="submit" value="Changer">
                    </form>
                </div>

                <div class="out_box">
                    <div class="recap">
                        <img src=<?php $img = $_SESSION["img"]; echo "\"$img\""; ?> alt="character">
                        <h2><?= $_SESSION["pseudo"]; ?></h2>
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
        <script src="./scripts/custom_character.js"></script>
        <script src="./scripts/dataImg.js"></script>
    </body>
</html>