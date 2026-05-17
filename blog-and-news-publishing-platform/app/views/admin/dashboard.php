<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;
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
