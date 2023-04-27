<?php
    include("./php/connect_check.php");
    include("./php/force_unaccess.php");

    include("./php/connect.php");
    include("./php/connect_fast.php");

    /**
     * Cette fonction vérifie si la méthode POST a été remplie.
     * 
     * @return boolean Renvoie true si la méthode POST est remplie, false sinon.
     */
    function check_POST() {
        if (isset($_POST["pseudo"], $_POST["dataImg"]))
            return true;
        return false;
    }

    if (check_POST()) {
        $id_player = $_SESSION["id"];
        if ($_POST["pseudo"] !== "") {
            $pseudo = $_POST["pseudo"];
            $request = "UPDATE player SET player.pseudo = \"$pseudo\"
                            WHERE player.id_player = $id_player;";
            @($db->query($request));

            $_SESSION["pseudo"] = $pseudo;
        }

        $img_profile = $_POST["dataImg"];
        $request = "UPDATE player SET player.img_profile = \"$img_profile\"
                        WHERE player.id_player = $id_player;";
        @($db->query($request));

        $_SESSION["img"] = $img_profile;
    }
?>