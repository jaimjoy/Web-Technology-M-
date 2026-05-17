<?php
require_once("../../middleware/editor.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

$sql="SELECT * FROM tags
ORDER BY name ASC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Tags</title>

    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >

</head>

<body>

<div class="container">

    <a
        href="dashboard.php"
        class="dashboard-card"
        style="display:inline-block;margin-bottom:20px;"
    >
        ← Back To Dashboard
    </a>

    <div class="premium-dashboard">

        <h1>Manage Tags</h1>

        <p>
            Add or delete tags
        </p>

    </div>

    <div class="card">

        <form onsubmit="addTag(event); return false;">

            <input
                type="text"
                id="tagName"
                name="name"
                placeholder="Tag Name"
                required
            >

            <button
                type="submit"
                name="add"
            >
                Add Tag
            </button>

        </form>

    </div>

    <div id="tagResults">
    <?php

    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div id='tag".$row["id"]."'>";

            echo "<div class='card'>";

            echo "<h3>";

            echo $row["name"];

            echo "</h3>";

            echo "
            <button
            onclick='deleteTag(
            ".$row["id"]."
            )'
            class='btn-danger'
            >
            Delete
            </button>
            ";

            echo "</div>";
            echo "</div>";
        }
    }
    else
    {
        echo "<div class='card'>No Tags Found</div>";
    }

    ?>
    </div>

</div>
<script>

function addTag(event)
{
    event.preventDefault();

    let name=
    document.getElementById(
        "tagName"
    ).value;

    let xhttp=
    new XMLHttpRequest();

    xhttp.open(
        "POST",
        "ajax_add_tag.php",
        true
    );

    xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhttp.onload=function()
    {
            document
        .getElementById(
            "tagResults"
        )
        .innerHTML+=this.responseText;

        document
        .getElementById(
            "tagName"
        )
        .value="";
    }

    xhttp.send(
        "name="+encodeURIComponent(name)
    );
}

function deleteTag(id)
{
    let xhttp=
    new XMLHttpRequest();

    xhttp.open(
        "POST",
        "ajax_delete_tag.php",
        true
    );

    xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhttp.onload=function()
    {
        document
        .getElementById(
            "tag"+id
        )
        .remove();
    }

    xhttp.send(
        "id="+id
    );
}

</script>

</body>

</html>