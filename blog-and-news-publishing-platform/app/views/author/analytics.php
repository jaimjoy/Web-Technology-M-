<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

$data = $article->getAuthorAnalytics(
    $_SESSION["user_id"]
);

?>
