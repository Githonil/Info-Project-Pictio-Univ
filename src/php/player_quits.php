<?php
    include("./connect.php");
    include("./connect_fast.php");

    session_start();

    $id_player = $_SESSION["id"];
    $room_code = $_SESSION["room_code"];

    /** Suppression de la liason entre le joueur et la partie. **/
    $request = "UPDATE player SET player.room_code = null
                    WHERE player.id_player = $id_player;";
    @($db->query($request));



    /** Changement de l'hôte si l'ancien leaves. **/
    $request = "SELECT game.id_player_host FROM game
                    WHERE game.room_code = \"$room_code\";";
    $result = @($db->query($request));

    $row = $result->fetch_assoc();
    if ($row["id_player_host"] == $id_player) {
        $request = "SELECT player.id_player FROM player
                        WHERE player.room_code = \"$room_code\";";
        $result = @($db->query($request));
        $row = $result->fetch_assoc();



        /** Suppression de la partie si il n'y a plus de joueur. **/
        if ($row === null) {
            $request = "DELETE FROM game WHERE game.room_code = \"$room_code\";";
            @($db->query($request));
        }
        else {
            /** La suite du changement d'host **/
            $new_id_player_host = $row["id_player"];
            $request = "UPDATE game SET game.id_player_host = $new_id_player_host
                            WHERE game.room_code = \"$room_code\";";
            @($db->query($request));
        }
    }



    /** Suppression du compte temporaire. **/
    $request = "SELECT player.forever_account FROM player
                    WHERE player.id_player = $id_player;";
    $result = @($db->query($request));
    $row = $result->fetch_assoc();

    if ($row["forever_account"] == 0) {
        $request = "DELETE FROM player WHERE player.id_player = $id_player;";
        @($db->query($request));

        session_reset();
        session_unset();
        session_destroy();
    }

    close_dataBase($db);
?>