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

<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
<body>
    <div class="container">
        <a
        href="dashboard.php"
        class="dashboard-card"
        style="display:inline-block;margin-bottom:20px;"
        >
            ← Back To Dashboard
        </a>

    <h1>Create Article</h1>

    <div class="card">
    <form method="POST">

        <input
            type="text"
            name="title"
            placeholder="Article Title"
        >

        <br><br>

        <textarea
            name="excerpt"
            rows="4"
            cols="50"
            placeholder="Excerpt"
        ></textarea>

        <br><br>

        <textarea
            name="body"
            rows="10"
            cols="50"
            placeholder="Article Body"
        ></textarea>

        <br><br>

        <select name="category_id">

            <?php

            while($category = $categories->fetch_assoc())
            {
                ?>

                <option value="<?php
                echo $category["id"];
                ?>">

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
            <option value="draft">Draft</option>
            <option value="pending">Submit For Review</option>
        </select>

        <br><br>
        
        <button type="submit"  name="create">Create Article</button>

    </form>
    </div>
    
</div>
</body>
</html>