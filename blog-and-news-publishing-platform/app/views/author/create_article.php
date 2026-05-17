<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

if(isset($_POST["create"]))
{
    $title = trim($_POST["title"]);
    $body = trim($_POST["body"]);
    $excerpt = trim($_POST["excerpt"]);
    $category_id = $_POST["category_id"];
    $status = $_POST["status"];

    if(!empty($title) &&!empty($body))
    {
        $article->createArticle(
            $_SESSION["user_id"],
            $category_id,
            $title,
            $body,
            $excerpt,
            $status
        );
        echo "Article Submitted For Review!";
    }
}

$categories = $article->getCategories();

?>

