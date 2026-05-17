<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_GET["delete"]))
{
    $id=$_GET["delete"];

    $sql="DELETE FROM articles
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    header("Location: manage_articles.php");

    exit();
}

$sql="SELECT
articles.*,
users.name AS author_name

FROM articles

JOIN users
ON articles.author_id=users.id";

$where=[];

if(
    isset($_GET["status"])
    &&
    !empty($_GET["status"])
)
{
    $status=$_GET["status"];

    $where[]=
    "articles.status='$status'";
}

if(
    isset($_GET["search"])
    &&
    !empty($_GET["search"])
)
{
    $search=$_GET["search"];

    $where[]=
    "articles.title LIKE '%$search%'";
}

if(count($where)>0)
{
    $sql.=" WHERE ";

    $sql.=implode(
        " AND ",
        $where
    );
}

    $sql.=" ORDER BY articles.created_at DESC,articles.created_at DESC";

       $result=$conn->query($sql);
    ?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Articles</title>

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

        <h1>Manage Articles</h1>

        <p>
            View and manage all platform articles
        </p>

    </div>

    <form method="GET" class="card">

        <select name="status">

            <option value="">
                All Status
            </option>

            <option value="published">
                Published
            </option>

            <option value="pending">
                Pending
            </option>

            <option value="draft">
                Draft
            </option>

            <option value="rejected">
                Rejected
            </option>

        </select>

        <input
            type="text"
            name="search"
            placeholder="Search article title"
         value="<?php
            if(isset($_GET["search"]))
            {
                echo $_GET["search"];
            }
        ?>"
>

        <button type="submit">
            Filter
        </button>

    </form>

    <br>

    <?php

    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            echo "<div class='card'>";

            echo "<h2>";

            echo $row["title"];

            echo "</h2>";

            echo "<b>Author:</b> ";

            echo $row["author_name"];

            echo "<br><br>";

            echo "<b>Status:</b> ";

            echo "<span class='status status-";

            echo $row["status"];

            echo "'>";

            echo ucfirst($row["status"]);

            echo "</span>";

            echo "<br><br>";

             echo "<b>Featured:</b> ";

            echo "<br><br>";

            echo "<a href='../reader/article.php?id=";

            echo $row["id"];

            echo "'>";

            echo "<button>";

            echo "Open Article";

            echo "</button>";

            echo "</a>";

            echo " ";

            echo "<a href='manage_articles.php?feature=";

            echo $row["id"];

            echo "'>";

            echo "</a>";

            echo " ";

            echo "<a href='manage_articles.php?delete=";

            echo $row["id"];

            echo "'>";

            echo "<button class='btn-danger'>";

            echo "Delete";

            echo "</button>";

            echo "</a>";

            echo "</div>";
        }
    }
    else
    {
        echo "<div class='card'>";

        echo "No Articles Found";

        echo "</div>";
    }

    ?>

</div>

</body>

</html>