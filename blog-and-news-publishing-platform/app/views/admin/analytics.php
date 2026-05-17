<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

$totalArticles=$conn->query(
"SELECT COUNT(*) AS total
FROM articles"
)->fetch_assoc()["total"];

$published=$conn->query(
"SELECT COUNT(*) AS total
FROM articles
WHERE status='published'"
)->fetch_assoc()["total"];

$pending=$conn->query(
"SELECT COUNT(*) AS total
FROM articles
WHERE status='pending'"
)->fetch_assoc()["total"];

$comments=$conn->query(
"SELECT COUNT(*) AS total
FROM comments"
)->fetch_assoc()["total"];

function percent($value,$total)
{
    if($total==0)
    {
        return 0;
    }

    return ($value/$total)*100;
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Analytics</title>

    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >

    <style>

    .bar
    {
        width:100%;
        background:#ddd;
        border-radius:20px;
        overflow:hidden;
        margin-top:10px;
    }

    .fill
    {
        height:25px;
        background:#1e88e5;
        text-align:center;
        color:white;
        line-height:25px;
    }

    </style>

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

    <div class="premium-dashboard">

        <h1>Platform Analytics</h1>

        <p>
            Visual overview of platform activity
        </p>

    </div>

    <div class="card">

        <h2>Total Articles</h2>

        <div class="bar">

            <div
                class="fill"
                style="width:100%"
            >

                <?php
                echo $totalArticles;
                ?>

            </div>

        </div>

        <br>

        <h2>Published Articles</h2>

        <div class="bar">

            <div
                class="fill"
                style="width:<?php
                echo percent(
                    $published,
                    $totalArticles
                );
                ?>%"
            >

                <?php
                echo $published;
                ?>

            </div>

        </div>

        <br>

        <h2>Pending Articles</h2>

        <div class="bar">

            <div
                class="fill"
                style="width:<?php
                echo percent(
                    $pending,
                    $totalArticles
                );
                ?>%"
            >

                <?php
                echo $pending;
                ?>

            </div>

        </div>

        <br>

        <h2>Total Comments</h2>

        <div class="bar">

            <div
                class="fill"
                style="width:100%"
            >

                <?php
                echo $comments;
                ?>

            </div>

        </div>

    </div>

</div>

</body>

</html>