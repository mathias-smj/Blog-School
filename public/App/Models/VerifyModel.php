<?php

namespace App\Models;

class VerifyModel extends DatabaseModel
{
    public static function syntaxeEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        header('Location : index.php');
        exit();
    }
}
