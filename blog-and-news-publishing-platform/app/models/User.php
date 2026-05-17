<?php
require_once(__DIR__ . "/../../config/database.php");

class User
{
    public function register($name,$username,$email,$password)
    {
        global $conn;

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $role = "reader";

        $sql = "INSERT INTO users
        (name,username,email,password_hash,role)
        VALUES
        (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssss",
            $name,
            $username,
            $email,
            $hashedPassword,
            $role
        );
        return $stmt->execute();
    }

    public function login($email)
    {
        global $conn;

        $sql = "SELECT * FROM users
        WHERE email = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "s",
            $email
        );
        
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
?>