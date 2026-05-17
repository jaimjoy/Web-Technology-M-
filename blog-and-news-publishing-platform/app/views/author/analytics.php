<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

$data = $article->getAuthorAnalytics(
    $_SESSION["user_id"]
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Author Analytics</title>
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

        <h1>Author Analytics</h1>

        <div class="card">
        <h3>Total Articles</h3>
        <?php echo $data["total_articles"]; ?>
        </div>

        <div class="card">
        <h3>Total Views</h3>
        <?php echo $data["total_views"] ?? 0; ?>
        </div>

        <div class="card">
        <h3>Total Likes</h3>
        <?php echo $data["total_likes"]; ?>
        </div>

        <div class="card">
        <h3>Total Comments</h3>
        <?php echo $data["total_comments"]; ?>
        </div>

    </div>
</body>
</html>