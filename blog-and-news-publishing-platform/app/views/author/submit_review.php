<?php

require_once("../../middleware/author.php");

require_once("../../models/Article.php");

$article = new Article();

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $article->submitForReview(
        $id,
        $_SESSION["user_id"]
    );

    header(
        "Location: draft_articles.php"
    );

    exit();
}
else
{
    die("Article ID Missing");
}

?>