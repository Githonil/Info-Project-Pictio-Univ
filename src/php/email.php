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

    $remove_no_error = true;
    $email_no_error = true;
    $password_no_error = true;

    if (check_POST()) {
        $id_player = $_SESSION["id"];
        if (isset($_POST["remove_emails"]))
            $remove_emails = $_POST["remove_emails"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $request = "SELECT player.password FROM player
                        WHERE player.id_player = $id_player;";
        $result = @($db->query($request));

        if (($row = $result->fetch_assoc()) !== null) {
            $password_no_error = password_verify($password, $row["password"]);

            if ($password_no_error) {
                if ($email !== "") {
                    $request = "SELECT email.mail FROM email
                                    WHERE email.mail = \"$email\";";
                    $result = @($db->query($request));
                    $email_no_error = $result->fetch_assoc() === null;

                    if ($email_no_error) {
                        $request = "INSERT INTO email (mail, id_player) VALUE (\"$email\", $id_player);";
                        @($db->query($request));
                    }
                }

                if (isset($_POST["remove_emails"])) {
                    $request = "SELECT email.mail FROM email
                                    WHERE email.id_player = $id_player;";
                    $result = @($db->query($request));

                    
                    if ($result->num_rows === 1 && count($remove_emails) === 1) {    
                        $remove_no_error = false;
                    }

                    else if ($result->num_rows >= 1) {
                        foreach ($remove_emails as $id) {
                            $request = "DELETE FROM email WHERE email.id_mail = $id;";
                            @($db->query("$request"));
                        }
                    }
                }
            }
        }
    }
?>