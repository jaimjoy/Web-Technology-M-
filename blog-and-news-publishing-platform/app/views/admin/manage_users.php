<?php
require_once("../../middleware/admin.php");
require_once(__DIR__ . "/../../../config/database.php");

global $conn;

if(isset($_GET["delete"]))
{
    $id=$_GET["delete"];

    $sql="DELETE FROM users
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "i",
        $id
    );

    $stmt->execute();

    header("Location: manage_users.php");
    exit();
}

if(isset($_POST["update_role"]))
{
    $id=$_POST["user_id"];

    $role=$_POST["role"];

    $sql="UPDATE users
    SET role=?
    WHERE id=?";

    $stmt=$conn->prepare($sql);

    $stmt->bind_param(
        "si",
        $role,
        $id
    );

    $stmt->execute();

    header("Location: manage_users.php");
    exit();
}

    $sql="SELECT *
    FROM users";

    $where=[];

    if(
        isset($_GET["search"])
        &&
        !empty($_GET["search"])
    )
    {
        $search=$_GET["search"];

        $where[]=
        "name LIKE '%$search%'";
    }

    if(
        isset($_GET["role"])
        &&
        !empty($_GET["role"])
    )
    {
        $role=$_GET["role"];

        $where[]=
        "role='$role'";
    }

    if(count($where)>0)
    {
        $sql.=" WHERE ";

        $sql.=implode(
            " AND ",
            $where
        );
    }

       $sql.=" ORDER BY created_at DESC";

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

    <form method="GET" class="card">

        <input
            type="text"
            id="searchInput"
            name="search"
            onkeyup="searchUsers()"
            placeholder="Search user name"
            value="<?php
            if(isset($_GET["search"]))
            {
                echo $_GET["search"];
            }
            ?>"
    >

            <select name="role">

                <option value="">
                    All Roles
                </option>

                <option value="reader">
                    Reader
                </option>

                <option value="author">
                    Author
                </option>

                <option value="editor">
                    Editor
                </option>

                <option value="admin">
                    Admin
                </option>

            </select>

                <button type="submit">
                    Filter
                </button>

    </form>

    <br>

    <div id="userResults">
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

            echo "<br><br>";

            echo "<form method='POST'>";

            echo "<input
            type='hidden'
            name='user_id'
            value='".$row["id"]."'>";

            echo "<select name='role'>";

            echo "<option value='reader'>Reader</option>";

            echo "<option value='author'>Author</option>";

            echo "<option value='editor'>Editor</option>";

            echo "<option value='admin'>Admin</option>";

            echo "</select>";

            echo "<button
            type='submit'
            name='update_role'>";

            echo "Update Role";

            echo "</button>";

            echo "</form>";

            echo "<br>";

            echo "<a href='manage_users.php?delete=".$row["id"]."'>";

            echo "<button class='btn-danger'>";

            echo "Delete User";

            echo "</button>";

            echo "</a>";

            echo "</div>";
        }
    }
    else
        {
            echo "<div class='card'>No Users Found</div>";
            }
            
            ?>
    </div>

</div>

<script>

function searchUsers()
{
    let search=
    document.getElementById(
        "searchInput"
    ).value;

    let xhttp=
    new XMLHttpRequest();

    xhttp.open(
        "POST",
        "ajax_user_search.php",
        true
    );

    xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
    );

    xhttp.onload=function()
    {
        document
        .getElementById(
            "userResults"
        )
        .innerHTML=this.responseText;
    }

    xhttp.send(
        "search="+encodeURIComponent(search)
    );
}

</script>

</body>

</html>