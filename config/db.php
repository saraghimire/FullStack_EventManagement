<?php
class Database {
    public static function connect() {
        $host = 'localhost';
        $db   = 'event_db';
        $user = 'root'; 
        $pass = ''; 

        //$db   = 'np02cs4s250012';
        //$user = 'np02cs4s250012'; 
        //$pass = 'DajF62ixgT'; 

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
}
?>