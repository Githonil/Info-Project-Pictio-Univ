<?php
    include("./connect.php");
    include("./connect_fast.php");

    session_start();

    if (!isset($_SESSION["room_code"])) {
        ?>

        <meta http-equiv="refresh" content="0;url=./index.php">

        <?php
    }

    $room_code = $_SESSION["room_code"];

    $request = "SELECT player.pseudo, player.img_profile FROM player
                    INNER JOIN game ON game.room_code = player.room_code
                    WHERE game.room_code = \"$room_code\";";
    $result = @($db->query($request));

    while (($row = $result->fetch_assoc()) !== null) {
        ?>

        <div class="player">
            <img src=<?php
                        $img = $row["img_profile"];
                        echo "\"$img\""; 
                    ?> alt="player">
            <h2><?= $row["pseudo"]; ?></h2>
        </div>

        <?php
    }

    close_dataBase($db);
?>