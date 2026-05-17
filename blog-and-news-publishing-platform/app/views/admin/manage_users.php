<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

$sql="SELECT *
FROM users
ORDER BY created_at DESC";

$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Users</title>

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

    <div class="premium-dashboard">

        <h1>Manage Users</h1>

        <p>
            Control user roles and accounts
        </p>

    </div>

    <?php

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h2>";

            echo $row["name"];

            echo "</h2>";

            echo "<b>Email:</b> ";

            echo $row["email"];

            echo "<br><br>";

            echo "<b>Current Role:</b> ";

            echo ucfirst($row["role"]);

            echo "</div>";
        }
    }
    else
    {
        echo "<div class='card'>No Users Found</div>";
    }

    ?>

</div>

</body>

</html>
