<?php
require_once("../../middleware/editor.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

$sql="SELECT articles.*,users.name AS author_name

FROM articles

JOIN users
ON articles.author_id=users.id

ORDER BY articles.created_at DESC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>All Articles</title>

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

        <h1>All Articles</h1>

        <p>
            Monitor all article statuses
        </p>

    </div>

    <?php

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h2>";

            echo $row["title"];

            echo "</h2>";

            echo "<b>Author:</b> ";

            echo $row["author_name"];

            echo "<br><br>";

            echo "<b>Status:</b> ";

            echo "<span class='status status-";

            echo $row["status"];

            echo "'>";

            echo ucfirst($row["status"]);

            echo "</span>";

            echo "<br><br>";

            // echo "<a href='review_article.php?id=".$row["id"]."'>";

            // echo "<button class='btn-success'>";

            // if($row["status"]=="pending")
            // {
            //     echo "Review";
            // }
            // else
            // {
            //     echo "Open";
            // }

            // echo "</button>";

            // echo "</a>";

            echo "</div>";
        }
    }
    else
    {
        echo "<div class='card'>No Articles Found</div>";
    }

    ?>

</div>

</body>

</html>