<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

if(!isset($_GET["id"]))
{
    die("Article ID Missing");
}

$id = $_GET["id"];
$row = $article->getArticleById($id);
$categories = $article->getCategories();

if(isset($_POST["update"]))
{
    $title = trim($_POST["title"]);
    $excerpt = trim($_POST["excerpt"]);
    $body = trim($_POST["body"]);
    $category_id = $_POST["category_id"];
    $status = $_POST["status"];

    $article->updateArticle(
        $id,
        $_SESSION["user_id"],
        $category_id,
        $title,
        $body,
        $excerpt,
        $status
    );
    echo "Article Updated";

    $row = $article->getArticleById($id);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
<body>

        <a
        href="dashboard.php"
        class="dashboard-card"
        style="display:inline-block;margin-bottom:20px;"
        >
            ← Back To Dashboard
        </a>
        
    <h1>Edit Article</h1>

   