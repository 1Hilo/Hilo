<?php

class DB {
    private static function connect(){
        $host = 'localhost';        //this is where you put the server name, e.g (localhost, 127.0.0.1"which is the ip of localhost.")
        $db   = 'socialnetwork'; 	// this is where you inset the database name of the database you have made.
        $user = 'root'; 	        // here is where you the username of the server you are using which in this case is root.
        $pass = '';			        // this is where you put the password of the user above. in this case there is no password.
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";//this connects the form to the server.
        $opt = [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION];	// this shows errors if form is not connected.

        $pdo = new PDO($dsn, $user, $pass, $opt); //this connects everything.
        return $pdo;
    }

    public static function query($query, $params = array ()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);

        if (explode ('_', $query)[0] == 'SELECT'){
            $data = $statement->fetchAll();
            return $data;
        }

    }
}
