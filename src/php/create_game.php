<?php
    include("./connect.php");
    include("./connect_fast.php");

    /**
     * Cette fonction vérifie si un code n'existe pas.
     * 
     * @param db La base de donnée.
     * @param code Le code a vérifier.
     * @return boolean Renvoie true si le code n'existe pas, false sinon.
     */
    function room_code_exist($db, $code) {
        $request = "SELECT game.room_code FROM game;";
        $result = @($db->query($request));

        while (($row = $result->fetch_assoc()) !== null) {
            if ($row["room_code"] === $code) 
                return false;
        }

        return true;
    }


    $data = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $room_code;

    session_start();

    $id_player = $_SESSION["id"];
    
    do {
        $room_code = substr(str_shuffle($data), 0, 8);
    } while (!room_code_exist($db, $room_code));

    $request = "INSERT INTO game (id_player_host, room_code, running, private_party, timer, nb_rounds, nb_words) VALUE ($id_player, \"$room_code\", 0, 0, 30, 3, 2);";
    @($db->query($request));

    $_SESSION["room_code"] = $room_code;

    $request = "UPDATE player SET player.room_code = \"$room_code\",
                                    player.score = 0
                    WHERE player.id_player = $id_player;";
    @($db->query($request));

    close_dataBase($db);
?>