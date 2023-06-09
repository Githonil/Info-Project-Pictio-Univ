<?php
    include("./php/connect.php");
    include("./php/connect_fast.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["email"], $_POST["password"]))
            return true;
        return false;
    }

    $login_check = false;

    $email_no_error = true;
    $password_no_error = true;

    if (check_POST()) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $request = "SELECT player.id_player, player.pseudo, player.password, player.img_profile, player.score, player.room_code FROM player
                        INNER JOIN email ON email.id_player = player.id_player
                        WHERE email.mail = \"$email\";";

        $result = @($db->query($request));

        if (($row = $result->fetch_assoc()) !== null) {
            $password_no_error = password_verify($password, $row["password"]);

            if ($password_no_error)
                $login_check = true;
                session_start();
                $_SESSION["id"] = $row["id_player"];
                $_SESSION["pseudo"] = $row["pseudo"];
                $_SESSION["img"] = $row["img_profile"];
                $_SESSION["score"] = $row["score"];
                $_SESSION["room_code"] = $row["room_code"];
        }
        else {
            $email_no_error = false;
        }
    }
?>