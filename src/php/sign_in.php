<?php
    include("./php/connect.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["email"], $_POST["pseudo"], $_POST["password"], $_POST["confirm_password"]))
            return true;
        return false;
    }

    $db = call_database("localhost", "root", "", "pictio_univ", 3306);

    $signin_check = false;

    $password_no_error = true;
    $email_no_error = true;

    if (check_POST()) {
        $email = $_POST["email"];
        $pseudo = $_POST["pseudo"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        $request = "SELECT email.mail FROM email
                        WHERE email.mail = \"$email\";";
        $result = @($db->query($request));

        $password_no_error = $password === $confirm_password;
        $email_no_error = $result->fetch_assoc() === null;

        if ($password_no_error && $email_no_error) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $request = "INSERT INTO player (pseudo, password) VALUE (\"$pseudo\", \"$passwordHash\");";
            @($db->query($request));

            $request = "SELECT MAX(player.id_player) FROM player;";
            $result = @($db->query($request));

            $id = ($result->fetch_assoc())["MAX(player.id_player)"];

            $request = "INSERT INTO email (mail, id_player) VALUE (\"$email\", $id);";
            @($db->query($request));

            $signin_check = true;
        }
    }
?>