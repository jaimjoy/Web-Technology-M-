<?php
require_once("../../middleware/reader.php");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Reader Dashboard</title>

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
            Explore your reading activities
        </p>

    </div>

    <div class="dashboard-grid">

        <a
            href="home.php"
            class="dashboard-card"
        >
            Browse Articles
        </a>

        <a
            href="saved_articles.php"
            class="dashboard-card"
        >
            Saved Articles
        </a>

        <a
            href="reading_history.php"
            class="dashboard-card"
        >
            Reading History
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