<?php

namespace App\Models;

class DatabaseModel
{
    private static string $host = "mysql";
    private static string $username = "root";
    private static string $password = "root";
    private static string $database = "blog_perfume";
    private static $conn;

    /**
     * Get a PDO database connection.
     *
     * @return \PDO The PDO database connection object.
     */
    public static function getConn()
    {
        if (!self::$conn) {
            try {
                self::$conn = new \PDO("mysql:host=" . self::$host . ";port=3306;dbname=" . self::$database . ";charset=UTF8", self::$username, self::$password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}

