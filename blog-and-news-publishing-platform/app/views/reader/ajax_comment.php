<?php
require_once("../../models/Article.php");

session_start();

$article=new Article();

if(
    isset($_POST["article_id"])
    &&
    isset($_POST["body"])
)
{
    $article_id=$_POST["article_id"];

    $body=trim($_POST["body"]);

    if(!empty($body))
    {
        $article->addComment(
            $article_id,
            $_SESSION["user_id"],
            $body
        );

        echo "
        <div class='card'>

            <b>
                ".$_SESSION["name"]."
            </b>

            <br><br>

            ".$body."

        </div>
        ";
    }
}
?>