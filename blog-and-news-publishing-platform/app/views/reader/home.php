<?php
session_start();
require_once("../../models/Article.php");

$article = new Article();
$popularArticles = $article->getPopularArticles();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
<body>

    <h1 id="bigTitle">Welcome to <b>Amader-Blog</b></h1>
    <h6 id="choto">A news & blog publishing platform</h6>

    <div class="container">
    <div class="navbar">
    <?php
    if(isset($_SESSION["user_id"]))
    {
        echo "<a href='dashboard.php'>Dashboard</a>";
        echo "<a href='../auth/logout.php'>Logout</a>";
    }
    else
    {
        echo "<a href='../auth/login.php'>Login</a>";
        echo "<a href='../auth/register.php'>Register</a>";
    }
    ?>

    </div>

    <h2 class="section-title">
    Popular Articles
    </h2>

    <?php
    if($popularArticles->num_rows > 0)
    {
        while($popular = $popularArticles->fetch_assoc())
        {
            echo "<a href='article.php?id=".$popular["id"]."'>";

            echo $popular["title"];

            echo "</a>";

            echo "<br><br>";
        }
    }

    ?>

    <h2 class="section-title">
    Published Articles
    </h2>

    </div>
</body>
</html>
