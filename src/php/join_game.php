<?php
    include("./connect.php");
    include("./connect_fast.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_GET() {
        if (isset($_GET["room_code"]))
            return true;
        return false;
    }

    if (!check_GET())
        return;

    session_start();

    $room_code = $_GET["room_code"];
    $id_player = $_SESSION["id"];

    if ($room_code === "") {
        $request = "SELECT game.room_code FROM game
                        WHERE game.private_party = 0;";
        $result = @($db->query($request));

        $size = $result->num_rows;
        $random = rand(0, $size - 1) - 1;

        while ($random > 0) {
            $result->fetch_assoc();
        }

        $row = $result->fetch_assoc();

        if ($row === null) {
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

            ?>

            <meta http-equiv="refresh" content="0;url=./../index.php">

            <?php
            close_dataBase($db);
            return;
        }

        $room_code = $row["room_code"];
    }

    $_SESSION["room_code"] = $room_code;
    $_SESSION["score"] = 0;

    $request = "UPDATE player SET player.room_code = \"$room_code\"
                    WHERE player.id_player = $id_player;";
    @($db->query($request));

    $request = "SELECT game.running FROM game
                    WHERE game.room_code = \"$room_code\";";
    $result = @($db->query($request));
    $row = $result->fetch_assoc();

    if ($row === null) {

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

        ?>

        <meta http-equiv="refresh" content="0;url=./../index.php">

        <?php
        close_dataBase($db);
        return;
    }

    if ($row["running"] === 1) {
        ?>

        <meta http-equiv="refresh" content="0;url=./../play.php">

        <?php
        close_dataBase($db);
        return;
    }

    ?>

    <meta http-equiv="refresh" content="0;url=./../host.php">

    <?php

    close_dataBase($db);
?>