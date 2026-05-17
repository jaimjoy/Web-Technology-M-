<?php
require_once("../../middleware/editor.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_POST["name"]))
{
    $name=trim($_POST["name"]);

    $slug=strtolower(
    str_replace(
        " ",
        "-",
        $name
    ));

    $slug=$slug."-".time();

    $sql="INSERT INTO categories(name,slug)
    VALUES(?,?)";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "ss",
        $name,
        $slug
    );

    $stmt->execute();

    $id=$conn->insert_id;

    echo "
    <div id='cat".$id."'>

        <div class='card'>

            <h3>
                ".$name."
            </h3>

            <button
            onclick='deleteCat(".$id.")'
            class='btn-danger'
            >
            Delete
            </button>

        </div>

    </div>
    ";
}
?>