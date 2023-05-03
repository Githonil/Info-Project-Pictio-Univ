<?php
    /**
     * Cette fonction crée la base de données du site Pictio-univ.
     * 
     * @param db La base de données vide.
     * @param name Le nom de la base de données.
     * @return db Renvoie la référence de la base de données.
     */
    function create_dataBase($db, $name) {
        $request = "CREATE DATABASE IF NOT EXISTS $name
                        DEFAULT CHARACTER SET utf8
                        DEFAULT COLLATE utf8_general_ci;";
        @($db->query($request));

        @($db->query("USE $name;"));



        $request = "CREATE TABLE IF NOT EXISTS player (
                        id_player INT AUTO_INCREMENT NOT NULL,
                        pseudo VARCHAR(30) NOT NULL,
                        password TEXT,
                        img_profile TEXT NOT NULL,
                        forever_account BIT NOT NULL,
                        score INT,
                        room_code VARCHAR(8),
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



        $request = "CREATE TABLE IF NOT EXISTS game (
                        id_game INT AUTO_INCREMENT NOT NULL,
                        id_player_host INT NOT NULL,
                        room_code VARCHAR(8) NOT NULL,
                        running BIT NOT NULL,
                        img_party TEXT,
                        private_party BIT NOT NULL,
                        timer INT NOT NULL, 
                        nb_rounds INT NOT NULL,
                        nb_words INT NOT NULL,
                        PRIMARY KEY (id_game),
                        FOREIGN KEY (id_player_host) REFERENCES player (id_player)
                    ) ENGINE=InnoDB;";
        @($db->query($request));



        $request = "CREATE TABLE IF NOT EXISTS word (
                        id_word INT AUTO_INCREMENT NOT NULL,
                        label VARCHAR(30) NOT NULL,
                        PRIMARY KEY (id_word)
                    ) ENGINE=InnoDB;";
        @($db->query($request));



        /*$requestTwo = "CREATE TABLE IF NOT EXISTS customword (
                        id_custom INT AUTO_INCREMENT NOT NULL,
                        label VARCHAR(30) NOT NULL,
                        room_code VARCHAR(8) NOT NULL,
                        PRIMARY KEY (id_custom)
                    ) ENGINE=InnoDB;";
        @($db->query($requestTwo));*/



        /*$requestTwo = "CREATE TABLE IF NOT EXISTS chatbox (
                        id_chat INT AUTO_INCREMENT NOT NULL,
                        msg VARCHAR(130) NOT NULL,
                        id_game INT NOT NULL,
                        PRIMARY KEY (id_chat),
                        FOREIGN KEY (id_game) REFERENCES game (id_game)
                    ) ENGINE=InnoDB;";
        @($db->query($requestTwo));*/

        rest_create($db);

        return $db;
    }

    /**
     * Le reste de la fonction create_dataBase.
     * 
     * @param db La base de donnée.
     * @return db Renvoie la base de donnée.
     */
    function rest_create($db) {
        $request = "CREATE TABLE IF NOT EXISTS customword (
                        id_custom INT AUTO_INCREMENT NOT NULL,
                        label VARCHAR(30) NOT NULL,
                        room_code VARCHAR(8) NOT NULL,
                        PRIMARY KEY (id_custom)
                    ) ENGINE=InnoDB;";
        @($db->query($request));



        $request = "CREATE TABLE IF NOT EXISTS chatbox (
                        id_chat INT AUTO_INCREMENT NOT NULL,
                        msg VARCHAR(130) NOT NULL,
                        id_game INT NOT NULL,
                        PRIMARY KEY (id_chat),
                        FOREIGN KEY (id_game) REFERENCES game (id_game)
                    ) ENGINE=InnoDB;";
        @($db->query($request));

        return $db;
    }



    
    function fill_tableWords($db) {
        $request = "SELECT word.id_word FROM word;";
        $result = @($db->query($request));
        $row = $result->fetch_assoc();

        if ($row === null) {
            $file = fopen("./words/wordsList.txt", "r+");

            while (($line = fgets($file)) !== false) {
                $db->set_charset("utf8");
                $line = $db->real_escape_string($line);
                $request = "INSERT INTO word (label) VALUES (\"$line\");";
                @($db->query($request));
            }

            fclose($file);
        }

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
        create_dataBase($db, $name);
        fill_tableWords($db);

        /*$request = "USE $name";
        @($db->query($request));*/

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

    $default_img = "data:image/png;base64,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";
?>