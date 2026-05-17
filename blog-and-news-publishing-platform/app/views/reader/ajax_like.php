<?php
require_once("../../models/Article.php");
session_start();

$article = new Article();

if(isset($_POST["article_id"]))
{
    $article_id = $_POST["article_id"];

    $article->likeArticle(
        $article_id,
        $_SESSION["user_id"]
    );

    $likes = $article->getLikeCount($article_id);

    header("Content-Type: application/json");
    echo json_encode($likes);
}