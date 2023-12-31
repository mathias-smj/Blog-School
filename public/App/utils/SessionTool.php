<?php

namespace App\utils;

use App\Models\UserModel;

class SessionTool
{
    /**
     * Create a session for the authenticated user.
     *
     * @param UserModel $user The user model representing the authenticated user.
     * @return void
     */
    public static function createSession(UserModel $user): void
    {
        $_SESSION['user'] = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'isAdmin' => $user->getIsAdmin()
        ];
    }

    /**
     * Clean up and destroy the user session.
     *
     * @return void
     */
    public static function cleanSession(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Check if a user is logged in.
     *
     * @return bool True if a user is logged in, false otherwise.
     */
    public static function userIsLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Check if the logged-in user is an admin.
     *
     * @return bool True if the logged-in user is an admin, false otherwise.
     */
    public static function userIsAdmin(): bool
    {
        return (isset($_SESSION['user']) && ($_SESSION['user']['isAdmin']));
    }
}
