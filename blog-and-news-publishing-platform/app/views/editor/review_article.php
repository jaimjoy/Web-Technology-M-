<?php
// session_start();
require_once("../../middleware/editor.php");
require_once("../../models/Article.php");

$article=new Article();

if(!isset($_GET["id"]))
{
    die("Article ID Missing");
}

$id=$_GET["id"];

$row=$article->getArticleById($id);

if(!$row)
{
    die("Article Not Found");
}

if(isset($_POST["update"]))
{
    $title=trim($_POST["title"]);

    $body=trim($_POST["body"]);

    $excerpt=trim($_POST["excerpt"]);

    $article->editorUpdateArticle(
        $id,
        $title,
        $body,
        $excerpt
    );

    header(
        "Location: review_article.php?id=".$id
    );

    exit();
}

if(isset($_POST["approve"]))
{
    $article->updateArticleStatus(
        $id,
        "published"
    );
    header("Location: review_articles.php");
    exit();
}

if(isset($_POST["reject"]))
{
    $article->updateArticleStatus(
        $id,
        "rejected"
    );
    header("Location: review_articles.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Review Article</title>

    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >

</head>

<body>

<div class="container">

    <div class="card">

        <h1>Review Article</h1>

        <br>

        <b>Author:</b>

        <?php
        echo $row["author_name"];
        ?>

        <br><br>

        <b>Status:</b>

        <span class="status status-<?php
        echo $row["status"];
        ?>">

            <?php
            echo ucfirst($row["status"]);
            ?>

        </span>

        <br><br>

        <form method="POST">

            <input
                type="text"
                name="title"
                value="<?php
                echo $row["title"];
                ?>"
                required
            >

            <textarea
                name="excerpt"
                rows="4"
                required
            ><?php
            echo $row["excerpt"];
            ?></textarea>

            <textarea
                name="body"
                rows="12"
                required
            ><?php
            echo $row["body"];
            ?></textarea>

            <button
                type="submit"
                name="update"
            >
                Update Article
            </button>

            <br><br>

            <?php

            if($row["status"]=="pending")
            {
            ?>

            <button
                type="submit"
                name="approve"
                class="btn-success"
            >
                Approve & Publish
            </button>

            <button
                type="submit"
                name="reject"
                class="btn-danger"
            >
                Reject
            </button>

            <?php
            }
            ?>

        </form>

    </div>

</div>

</body>

</html>