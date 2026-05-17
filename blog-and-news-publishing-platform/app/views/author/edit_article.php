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

    <form method="POST">

        <input
            type="text"
            name="title"
            value="<?php echo $row["title"]; ?>"
        >

        <br><br>

        <textarea
            name="excerpt"
            rows="4"
            cols="50"
        ><?php
        echo $row["excerpt"];
        ?></textarea>

        <br><br>

        <textarea
            name="body"
            rows="10"
            cols="50"
        ><?php
        echo $row["body"];
        ?></textarea>

        <br><br>

        <select name="category_id">

            <?php

            while($category = $categories->fetch_assoc())
            {
                ?>

                <option
                    value="<?php
                    echo $category["id"];
                    ?>"

                    <?php

                    if(
                        $category["id"] ==
                        $row["category_id"]
                    )
                    {
                        echo "selected";
                    }

                    ?>
                >

                    <?php
                    echo $category["name"];
                    ?>

                </option>

                <?php
            }

            ?>

        </select>

        <br><br>

        <select name="status">

        <option
            value="pending"

            <?php
            if($row["status"]=="pending")
            {
                echo "selected";
            }
            ?>
        >
            Submit For Review
        </option>

    </select>

        <br><br>

        <button
            type="submit"
            name="update"
        >
            Update Article
        </button>
    </form>

</body>
</html>