<?php
    include("./php/connect_check.php");
    include("./php/force_unaccess.php");

    include("./php/connect.php");
    include("./php/connect_fast.php");

    $room_code = $_SESSION["room_code"];
    $request = "SELECT game.id_player_host FROM game
                    WHERE game.room_code = \"$room_code\";";
    $result = @($db->query($request));
    $row = $result->fetch_assoc();
    
    $is_owner = $row["id_player_host"] === $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>Accueil de la partie : <?= $_SESSION["room_code"]; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/svg" href="./images/logo.svg">
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link rel="stylesheet" type="text/css" href="./styles/host.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="./scripts/player_quits.js"></script>
    </head>
    <body>
        <header>
            <a href="./index.php"><img src="./images/logo.svg" alt="logo"></a>
        </header>

        <main>
            <section class="host">
                <h1>Code de la salle : <?= $_SESSION["room_code"]; ?></h1>

                <div class="config">
                    <label>
                        Partie privée :
                        <input type="checkbox" name="private_party" id="private_party" <?= $is_owner ? "" : "disabled"; ?>>
                    </label>

                    <label>
                        Temps de dessins :
                        <select name="timer" id="timer" <?= $is_owner ? "" : "disabled"; ?>>
                            <option value="30">30s</option>
                            <option value="60">60s</option>
                            <option value="90">90s</option>
                            <option value="120">120s</option>
                            <option value="150">150s</option>
                            <option value="180">180s</option>
                        </select>
                    </label>

                    <label>
                        Nombre de tours :
                        <select name="nb_rounds" id="nb_rounds" <?= $is_owner ? "" : "disabled"; ?>>
                            <option value="3">3</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                        </select>
                    </label>

                    <label>
                        Nombre de mots proposés lors du choix du tours.
                        <select name="nb_words" id="nb_words" <?= $is_owner ? "" : "disabled"; ?>>
                            <option value="3">2</option>
                            <option value="5">3</option>
                            <option value="7">4</option>
                            <option value="10">5</option>
                        </select>
                    </label>

                </div>

                <div class="guests">
                </div>

                <nav>
                    <button class="play" <?= $is_owner ? "" : "disabled"; ?>>Jouer</button>
                    <a href="./redirectLong.html">Quitter</a>
                </nav>

            </section>
        </main>

        <script src="./scripts/host.js"></script>
    </body>
</html>

<?php
    close_dataBase($db);
?>