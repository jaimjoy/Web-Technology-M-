<?php
require_once("../../models/Article.php");
session_start();

$article = new Article();

if(isset($_POST["like"]) && isset($_SESSION["user_id"]))
{
    $article->likeArticle(
        $_GET["id"],
        $_SESSION["user_id"]
    );
}

if(isset($_GET["id"]))
{
    $id = $_GET["id"];
    $article->increaseViewCount($id);
    if(isset($_SESSION["user_id"]))
    {
        $article->saveReadingHistory(
            $id,
            $_SESSION["user_id"]
        );
    }

    $row = $article->getArticleById($id);
    $comments = $article->getComments($id);
    $likes = $article->getLikeCount($id);
}
else
{
    die("Article ID Missing");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Article Details</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
<body>
    <div class="container">
        <a
            href="home.php"
            class="dashboard-card"
            style="display:inline-block;margin-bottom:20px;"
            >
                ← Back To Home
        </a>

    <?php

    if($row)
    {
        echo "<div class='card'>";

        echo "<h1>";
        echo $row["title"];
        echo "</h1>";

        echo "<b>Author:</b> ";
        echo $row["author_name"];

        echo "<br><br>";

        echo "<b>Views:</b> ";
        echo $row["view_count"];

        echo "<br><br>";

        echo "<b>Likes:</b> ";
        echo "<span id='likeCount'>";
        echo $likes["total_likes"];
        echo "</span>";

        echo "<br><br>";

        echo "<p>";
        echo $row["body"];
        echo "</p>";

        if(isset($_SESSION["user_id"]))
        {
            echo "
            <br>
            <button
            onclick='likeArticle()'
            class='btn-success'
            >
            Like
            </button>
            ";
        }

        if(isset($_SESSION["user_id"]))
        {
            echo "
            <br>
            <button
            onclick='saveArticle()'
            id='saveBtn'
            class='btn-success'
            >
            Save Article
            </button>
            ";
        }

        if(isset($_SESSION["user_id"]))
        {
            echo "<hr>";

            echo "<h3>Add Comment</h3>";

            echo "
            <textarea
            id='commentBody'
            rows='5'
            cols='50'
            placeholder='Write Comment'
            ></textarea>

            <br><br>

            <button
            onclick='addComment()'
            class='btn-success'
            >
            Comment
            </button>
            ";
        }
        else
        {
            echo "<br>";

            echo "
            <a href='../auth/login.php'>
                Login To Like, Save & Comment
            </a>
            ";
}

        echo "<hr>";
        echo "<h3>Comments</h3>";
        echo "<div id='commentsSection'>";
        if($comments->num_rows > 0)
        {
            while($comment = $comments->fetch_assoc())
            {
                echo "<div class='card'>";
                echo "<b>";
                echo $comment["name"];
                echo "</b>";

                echo "<br><br>";

                echo $comment["body"];

                echo "<br>";
                echo "</div>";
                echo "</div>";
            }
        }
        else
        {
            echo "No Comments Yet";
        }
        echo "</div>";
    }
    else
    {
        echo "Article Not Found";
    }

    ?>

    <script>
        function likeArticle()
        {
            let xhttp = new XMLHttpRequest();

            xhttp.open("POST","ajax_like.php",true);

            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

            xhttp.onload = function()
            {
                let data =
                JSON.parse(this.responseText);
                document
                .getElementById(
                    "likeCount"
                )
                .innerHTML =
                data.total_likes;
            }

            xhttp.send("article_id=<?php echo $row['id']; ?>");
        }

        function saveArticle()
        {
            let xhttp=
            new XMLHttpRequest();

            xhttp.open(
                "POST",
                "ajax_save.php",
                true
            );

            xhttp.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhttp.onload=function()
            {
                document
                .getElementById(
                    "saveBtn"
                )
                .innerHTML=this.responseText;
            }

            xhttp.send(
                "article_id=<?php
                echo $row['id'];
                ?>"
            );
        }

        function addComment()
        {
            let body=
            document.getElementById(
                "commentBody"
            ).value;

            if(body=="")
            {
                return;
            }

            let xhttp=
            new XMLHttpRequest();

            xhttp.open(
                "POST",
                "ajax_comment.php",
                true
            );

            xhttp.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );

            xhttp.onload=function()
            {
                document
                .getElementById(
                    "commentsSection"
                )
                .innerHTML+=this.responseText;

                document
                .getElementById(
                    "commentBody"
                )
                .value="";
            }

            xhttp.send(
                "article_id=<?php
                echo $row['id'];
                ?>&body="+encodeURIComponent(body)
            );
        }
</script>
    </div>
</body>
</html>