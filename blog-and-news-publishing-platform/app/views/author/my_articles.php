<?php
require_once("../../middleware/author.php");
require_once("../../models/Article.php");

$article = new Article();

$result = $article->getAuthorOwnArticles(
    $_SESSION["user_id"]
);

?>

