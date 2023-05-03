<?php
    include("./connect.php");
    include("./connect_fast.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["private_party"], $_POST["timer"], $_POST["nb_rounds"]))
            return true;
        return false;
    }

    if (!check_POST())
        return;

    session_start();

    $private = (int) $_POST["private_party"];
    $timer = (int) $_POST["timer"];
    $nb_rounds = (int) $_POST["nb_rounds"];
    $room_code = $_SESSION["room_code"];

    $request = "UPDATE game SET game.private_party = $private AND
                                game.timer = $timer AND
                                game.nb_rounds = $nb_rounds
                    WHERE game.room_code = \"$room_code\";";
    @($db->query($request));

    close_dataBase($db);
?>