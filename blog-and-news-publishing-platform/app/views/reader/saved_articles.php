<?php
require_once("../../models/Article.php");
session_start();

$article = new Article();
if(isset($_GET["remove"]))
{
    $article->removeSavedArticle(
        $_GET["remove"],
        $_SESSION["user_id"]
    );

    header("Location: saved_articles.php");
    exit();
}

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
            echo "<a href='saved_articles.php?remove=";

            echo $row["id"];

            echo "'>";

            echo "<button class='btn-danger'>";

            echo "Remove";

            echo "</button>";

            echo "</a>";
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