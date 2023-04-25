<?php
    include("./php/connect.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["email"], $_POST["pseudo"], $_POST["password"]))
            return true;
        return false;
    }

    $db = call_dataBase("localhost", "root", "", "pictio_univ", 3306);

    $login_check = false;

    $email_no_error = true;
    $pseudo_no_error = true;
    $password_no_error = true;

    if (check_POST()) {
        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];

        $request = "SELECT player.id_player, player.pseudo, player.password FROM player
                        INNER JOIN email ON email.id_player = player.id_player
                        WHERE email.mail = \"$email\";";

        $result = @($db->query($request));

        if (($row = $result->fetch_assoc()) !== null) {
            $pseudo_no_error = $row["pseudo"] === $pseudo;
            $password_no_error = password_verify($password, $row["password"]);

            if ($pseudo_no_error && $password_no_error)
                $login_check = true;
                session_start();
                $_SESSION["pseudo"] = $pseudo;
                $_SESSION["email"] = $email;
        }
        else {
            $email_no_error = false;
        }
    }
?>