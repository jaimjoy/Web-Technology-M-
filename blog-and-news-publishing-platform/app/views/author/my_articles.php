<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

$result = $article->getAuthorOwnArticles(
    $_SESSION["user_id"]
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Articles</title>
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

    <h1>My Articles</h1>

    <?php

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<div id='article".$row["id"]."'>";

            echo "<div class='card'>";

            echo "<h3>";

            echo $row["title"];

            echo "</h3>";

            echo "<b>Status:</b> ";

            echo "<span class='status status-";

            echo $row["status"];

            echo "'>";

            echo ucfirst($row["status"]);

            echo "</span>";

            echo "<br><br>";
            echo "</div>";

            echo "<a href='edit_article.php?id=";

            echo $row["id"];

            echo "'>";

            echo "<button>Edit</button>";

            echo "</a>";

            echo " | ";

            echo "
            <button
            onclick='deleteArticle(
            ".$row["id"]."
            )'
            class='btn-danger'
            >
            Delete
            </button>
            ";

            echo "<br><br>";
            echo "</div>";
        }
    }
    else
    {
        echo "No Articles Found";
    }

    ?>
    </div>

    <script>

