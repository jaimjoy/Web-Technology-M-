<!-- Editor Dashboard -->
<?php
require_once("../../middleware/editor.php");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Editor Dashboard</title>

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
            Manage reviews and categories
        </p>

    </div>

    <div class="dashboard-grid">
        
        <a
        href="all_articles.php"
        class="dashboard-card"
        >
        All Articles
        </a>
        <a
            href="review_articles.php"
            class="dashboard-card"
        >
            Review Articles
        </a>

        <a
            href="manage_categories.php"
            class="dashboard-card"
        >
            Manage Categories
        </a>

        <a
            href="manage_tags.php"
            class="dashboard-card"
        >
            Manage Tags
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