<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

$totalUsers=$conn->query(
"SELECT COUNT(*) AS total
FROM users"
)->fetch_assoc()["total"];

$totalArticles=$conn->query(
"SELECT COUNT(*) AS total
FROM articles"
)->fetch_assoc()["total"];

$publishedArticles=$conn->query(
"SELECT COUNT(*) AS total
FROM articles
WHERE status='published'"
)->fetch_assoc()["total"];

$pendingArticles=$conn->query(
"SELECT COUNT(*) AS total
FROM articles
WHERE status='pending'"
)->fetch_assoc()["total"];

$totalComments=$conn->query(
"SELECT COUNT(*) AS total
FROM comments"
)->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
<body>

<div class="container">

    <div class="premium-dashboard">

        <h1>
            Welcome,
            <?php
            echo $_SESSION["name"];
            ?>
        </h1>

        <p>
            Manage users and platform settings
        </p>

    </div>

    <div class="dashboard-grid">

        <a
            href="manage_articles.php"
            class="dashboard-card"
        >
            Manage Articles
        </a>

        <a
            href="manage_users.php"
            class="dashboard-card"
        >
            Manage Users
        </a>

        <a
            href="manage_comments.php"
            class="dashboard-card"
        >
            Manage Comments
        </a>

        <a
            href="analytics.php"
            class="dashboard-card"
        >
            Analytics
        </a>

        <div class="dashboard-card">

            <h2>
                <?php
                echo $totalUsers;
                ?>
            </h2>

            <p>Total Users</p>

        </div>

        <div class="dashboard-card">

            <h2>
                <?php
                echo $totalArticles;
                ?>
            </h2>

            <p>Total Articles</p>

        </div>

        <div class="dashboard-card">

            <h2>
                <?php
                echo $publishedArticles;
                ?>
            </h2>

            <p>Published Articles</p>

        </div>

        <div class="dashboard-card">

            <h2>
                <?php
                echo $pendingArticles;
                ?>
            </h2>

            <p>Pending Reviews</p>

        </div>

        <div class="dashboard-card">

            <h2>
                <?php
                echo $totalComments;
                ?>
            </h2>

            <p>Total Comments</p>

        </div>
    </div>

    </div>
    <div class="container">

    <div style="text-align:right;margin-bottom:20px;">

        <a href="../auth/logout.php">

            <button class="btn-danger">
                Logout
            </button>

        </a>

    </div>

</div>

</body>

</html>