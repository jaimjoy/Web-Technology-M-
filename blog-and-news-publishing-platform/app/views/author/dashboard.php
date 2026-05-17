<!-- Author Dashboard -->
<?php
require_once("../../middleware/author.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Author Dashboard</title>

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
            <?php echo $_SESSION["name"]; ?>
        </h1>

        <p>
            Manage your articles and analytics
        </p>

    </div>

    <div class="dashboard-grid">

        <a
            href="create_article.php"
            class="dashboard-card"
        >
            Create Article
        </a>

        <a
            href="my_articles.php"
            class="dashboard-card"
        >
            My Articles
        </a>

        <a
            href="draft_articles.php"
            class="dashboard-card"
        >
            Draft Articles
        </a>

        <a
            href="analytics.php"
            class="dashboard-card"
        >
            Analytics
        </a>

        <a
            href="../auth/logout.php"
            class="dashboard-card logout-card"
        >
            Logout
        </a>

    </div>

</div>

</body>
</html>