<?php
require_once("../../middleware/editor.php");
require_once("../../models/Article.php");

$article = new Article();

global $conn;

$sql="SELECT * FROM categories
ORDER BY name ASC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Categories</title>

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

        <h1>Manage Categories</h1>

        <p>
            Add or delete categories
        </p>

    </div>

    <div class="card">

        <form onsubmit="addCat(event); return false;">

            <input
                type="text"
                id="catName"
                name="name"
                placeholder="Category Name"
                required
            >

            <button
                type="submit"
                name="add"
            >
                Add Category
            </button>

        </form>

    </div>

    <div id="catResults">
    <?php

    if($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div id='cat".$row["id"]."'>";

            echo "<div class='card'>";

            echo "<h3>";

            echo $row["name"];

            echo "</h3>";

            echo "
            <button
            onclick='deleteCat(
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
        echo "<div class='card'>No Categories Found</div>";
    }

    ?>
    </div>

</div>
<script>

function addCat(event)
{
    event.preventDefault();

    let name=
    document.getElementById(
        "catName"
    ).value;

    let xhttp=
    new XMLHttpRequest();

    xhttp.open(
        "POST",
        "ajax_add_category.php",
        true
    );

    xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhttp.onload=function()
{
    let data=
    JSON.parse(this.responseText);

    document
    .getElementById(
    "catResults"
    )
    .innerHTML+=
    `
    <div id="cat${data.id}">
        <div class="card">

            <h3>
                ${data.name}
            </h3>

            <button
            onclick="deleteCat(${data.id})"
            class="btn-danger"
            >
            Delete
            </button>

        </div>
    </div>
    `;

    document
    .getElementById(
    "catName"
    )
    .value="";
}

    xhttp.send(
        "name="+encodeURIComponent(name)
    );
}

function deleteCat(id)
{
    let xhttp=
    new XMLHttpRequest();

    xhttp.open(
        "POST",
        "ajax_delete_category.php",
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
            "cat"+id
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