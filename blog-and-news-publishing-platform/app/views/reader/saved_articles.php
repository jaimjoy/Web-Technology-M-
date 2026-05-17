<?php
require_once("../../models/Article.php");
session_start();

$article = new Article();

$result = $article->getSavedArticles(
    $_SESSION["user_id"]
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Articles</title>
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

    <h2>Saved Articles</h2>

    <?php
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h3>";

            echo "<a href='article.php?id=".$row["id"]."'>";

            echo $row["title"];

            echo "</a>";

            echo "</h3>";

            echo "<p>";

            echo $row["excerpt"];

            echo "</p>";
            echo "</div>";
        }
    }
    else
    {
        echo "No Saved Articles";
    }
    ?>
    </div>
</body>
</html>
