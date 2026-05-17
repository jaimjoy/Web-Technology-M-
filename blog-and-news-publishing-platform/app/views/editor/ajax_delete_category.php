<?php
require_once("../../middleware/editor.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_POST["id"]))
{
    $id=$_POST["id"];

    $sql="DELETE FROM categories
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();
}
?>