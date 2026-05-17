<?php
require_once("../../models/Article.php");
session_start();

global $conn;

$sql = "SELECT articles.*
FROM reading_history
JOIN articles
ON reading_history.article_id = articles.id
WHERE reading_history.user_id = ?
ORDER BY reading_history.read_at DESC";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $_SESSION["user_id"]
);

$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reading History</title>
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

    <h2>Reading History</h2>

    <?php

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h3>";

            echo $row["title"];

            echo "</h3>";

            echo "</div>";
        }
    }
    else
    {
        echo "No Reading History";
    }

    ?>
    </div>
</body>
</html>
