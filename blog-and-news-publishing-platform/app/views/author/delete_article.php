<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $article->deleteArticle(
        $id,
        $_SESSION["user_id"]
    );

    header("Location: my_articles.php");
    exit();
}
else
{
    die("Article ID Missing");
}

?>