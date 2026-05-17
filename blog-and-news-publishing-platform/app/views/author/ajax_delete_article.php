<?php
require_once("../../middleware/author.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_POST["id"]))
{
    $id=$_POST["id"];

    $sql="DELETE FROM articles
    WHERE id=?
    AND author_id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "ii",
        $id,
        $_SESSION["user_id"]
    );

    $stmt->execute();

    header("Content-Type: application/json");
    echo json_encode([
        "status"=>"success",
        "message"=>"Article Deleted"
    ]);
}
?>