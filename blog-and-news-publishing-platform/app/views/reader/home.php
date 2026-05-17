<?php
session_start();
require_once("../../models/Article.php");

$article = new Article();
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

    </div>
</body>
</html>
