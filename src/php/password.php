<?php
    include("./php/connect.php");

    $db = call_dataBase("localhost", "root", "", "pictio_univ", 3306);

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["new_password"], $_POST["confirm_new_password"], $_POST["password"]))
            return true;
        return false;
    }

    $modif_check = false;

    $password_no_error = true;
    $confirm_password_no_error = true;

    if (check_POST()) {
        $id_player = $_SESSION["id"];
        $new_password = $_POST["new_password"];
        $confirm_new_password = $_POST["confirm_new_password"];
        $password = $_POST["password"];

        $request = "SELECT player.password FROM player
                        WHERE player.id_player = $id_player;";
        $result = @($db->query($request));

        if (($row = $result->fetch_assoc()) !== null) {
            $password_no_error = password_verify($password, $row["password"]);

            if ($password_no_error) {
                $confirm_password_no_error = $new_password === $confirm_new_password;

                if ($confirm_password_no_error) {
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $request = "UPDATE player SET player.password = \"$new_password\"
                                    WHERE player.id_player = $id_player;";
                    @($db->query($request));

                    $modif_check = true;
                }
            }
        }
    }
?>