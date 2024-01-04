<?php

namespace app\Models;

use app\Models\DatabaseModel;
use PDO;

class UserModel extends DatabaseModel
{
    private $conn;
    private string $username;
    private string $email;
    private string $password;
    private bool $isAdmin;

    /**
     * Get the username of the user.
     *
     * @return string The username of the user.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the email address of the user.
     *
     * @return string The email address of the user.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the password of the user.
     *
     * @return string The hashed password of the user.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * Initialize the UserModel and establish a database connection.
     */
    public function __construct()
    {
        $this->conn = DatabaseModel::getConn();
    }

    /**
     * Create a new user in the database.
     *
     * @param string $userName The username of the user to create.
     * @param string $email    The email address of the user to create.
     * @param string $password The hashed password of the user to create.
     * @return void
     */
    public function create(string $userName, string $email, string $password): void
    {
        $query = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            $userName,
            $email,
            $password
        ]);
    }

    /**
     * Retrieve a user by their email address from the database.
     *
     * @param string $email The email address of the user to retrieve.
     * @return bool True if the user exists and is retrieved, false otherwise.
     */
    public function getUserByEmail(string $email): bool
    {
        try {
            $query = "SELECT * FROM Users WHERE (email = :email)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user !== false) {
                $this->username = $user["username"];
                $this->email = $user["email"];
                $this->password = $user["password"];
                $this->isAdmin = $user['isAdmin'];
                return true;
            }
            return false;

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * Check if a user with the given email address already exists in the database.
     *
     * @param string $email The email address to check.
     * @return bool True if a user with the email address exists, false otherwise.
     */
    public static function userExists(string $email): bool
    {
        $conn = DatabaseModel::getConn();
        $query = "SELECT COUNT(*) FROM Users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
}
