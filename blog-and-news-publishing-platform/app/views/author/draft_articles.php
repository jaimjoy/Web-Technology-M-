<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");
$article = new Article();

$result = $article->getDraftArticles(
    $_SESSION["user_id"]
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Draft Articles</title>
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

    <h1>Draft Articles</h1>
    <?php
    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h3>";

            echo $row["title"];

            echo "</h3>";

            echo "<b>Status:</b> ";

            echo $row["status"];

            echo "<br><br>";
            echo "</div>";

            echo "<a href='edit_article.php?id=";

            echo $row["id"];

            echo "'>";

            echo "<button>Edit</button>";

            echo "</a>";

            echo " | ";

            echo "<a href='delete_article.php?id=";

            echo $row["id"];

            echo "'>";

            echo "<button class='btn-danger'>Delete</button>";

            echo " | ";

            echo "<a href='submit_review.php?id=";

            echo $row["id"];

            echo "'>";

            echo "<button class='btn-success'>Submit For Review</button>";

            echo "</a>";

            echo "</a>";

            echo "<br><br>";
        }
    }
    else
    {
        echo "No Draft Articles";
    }
    ?>
    </div>
</body>
</html>

