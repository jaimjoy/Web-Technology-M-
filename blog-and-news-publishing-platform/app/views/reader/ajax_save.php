<?php
require_once("../../models/Article.php");

session_start();

$article=new Article();

if(isset($_POST["article_id"]))
{
    $article_id=$_POST["article_id"];

    $article->saveArticle(
        $article_id,
        $_SESSION["user_id"]
    );

    echo "Saved";
}
?>