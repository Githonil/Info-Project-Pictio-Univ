<?php
    include("./connect.php");
    include("./connect_fast.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["img"], $_POST["pseudo"], $_POST["room_code"]))
            return true;
        return false;
    }

    if (!check_POST())
        return;

    $pseudo = $_POST["pseudo"];
    $img = $_POST["img"];
    $room_code = $_POST["room_code"];

    $request = "INSERT INTO player (pseudo, img_profile, forever_account, score, room_code) VALUE (\"$pseudo\", \"$img\", 0, 0, \"$room_code\");";
    @($db->query($request));

    session_start();

    $request = "SELECT MAX(player.id_player) FROM player;";
    $result = @($db->query($request));

    $id = ($result->fetch_assoc())["MAX(player.id_player)"];

    $_SESSION["id"] = $id;
    $_SESSION["pseudo"] = $pseudo;
    $_SESSION["img"] = $img;
    $_SESSION["score"] = 0;
    
    close_dataBase($db);
?>