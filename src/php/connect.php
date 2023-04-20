<?php
    /**
     * Cette fonction crée la base de données de Pictio-univ.
     * 
     * @param db La base de données vide.
     * @return db Renvoie la référence de la base de données.
     */
    function create_dataBase($db) {
        $request = "CREATE DATABASE IF NOT EXISTS pictio_univ
                        DEFAULT CHARACTER SET utf8mb4
                        DEFAULT COLLATE utf8mb4_general_ci;";
        @($db->query($request));

        @($db->query("USE pictio_univ;"));

        $request = "CREATE TABLE IF NOT EXISTS player (
                        id_player INT AUTO_INCREMENT NOT NULL,
                        pseudo VARCHAR(30) NOT NULL,
                        password TEXT NOT NULL,
                        PRIMARY KEY (id_player)
                    ) ENGINE=InnoDB;";
        @($db->query($request));

        $request = "CREATE TABLE IF NOT EXISTS email (
                        id_mail INT AUTO_INCREMENT NOT NULL,
                        mail VARCHAR(50) NOT NULL,
                        id_player INT NOT NULL,
                        PRIMARY KEY (id_mail),
                        FOREIGN KEY (id_player) REFERENCES player (id_player)
                    ) ENGINE=InnoDB;";
        @($db->query($request));

        return $db;
    }

    /**
     * Cette fonction appele une base de données.
     * Si la base de donnée n'existe pas, alors elle est crée.
     * 
     * @param host L'IP de l'hôte.
     * @param port Le port de l'IP.
     * @param name Le nom de la base de données.
     * @return db Renvoie la base de données.
     */
    function call_dataBase($host, $userName, $password, $name, $port = 0) {
        ($port === 0) ? $db = @(new mysqli($host, $userName, $password, $name)) : $db = @(new mysqli($host, $userName, $password, $name, $port));
        if ($db->connect_errno) {
            $db = @(new mysqli($host, "root", ""));
        }
        create_dataBase($db);

        $request = "USE $name";
        @($db->query($request));

        return $db;
    }



    /**
     * Cette fonction ferme l'appel à une base de données.
     * 
     * @param db La base de données.
     */
    function close_dataBase($db) {
        @($db->close());
    }
?>