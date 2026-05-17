<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_POST["user_id"]) && isset($_POST["role"]))
{
    $id=$_POST["user_id"];

    $role=$_POST["role"];

    $sql="UPDATE users
    SET role=?
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "si",
        $role,
        $id
    );

    $stmt->execute();

    header("Content-Type: application/json");

    echo json_encode([
        "status"=>"success",
        "message"=>"Role Updated"
    ]);
}
?>