<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_GET["delete"]))
{
    $id=$_GET["delete"];

    $sql="DELETE FROM comments
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    header("Location: manage_comments.php");

    exit();
}

$sql="SELECT
comments.*,
users.name AS user_name,
articles.title AS article_title

FROM comments

JOIN users
ON comments.user_id=users.id

JOIN articles
ON comments.article_id=articles.id

ORDER BY comments.created_at DESC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Comments</title>

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

        <h1>Manage Comments</h1>

        <p>
            Moderate all platform comments
        </p>

    </div>

    <?php

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h3>";

            echo $row["user_name"];

            echo "</h3>";

            echo "<b>Article:</b> ";

            echo $row["article_title"];

            echo "<br><br>";

            echo "<b>Comment:</b>";

            echo "<p>";

            echo $row["body"];

            echo "</p>";

            echo "<a href='manage_comments.php?delete=";

            echo $row["id"];

            echo "'>";

            echo "<button class='btn-danger'>";

            echo "Delete Comment";

            echo "</button>";

            echo "</a>";

            echo "</div>";
        }
    }
    else
    {
        echo "<div class='card'>";

        echo "No Comments Found";

        echo "</div>";
    }

    ?>

</div>

</body>

</html>