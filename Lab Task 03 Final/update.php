<?php
include 'db.php';

$row = "";

if(isset($_GET['reg_no']))
{
    $reg_no = $_GET['reg_no'];
    $result = $conn->query("SELECT * FROM student WHERE registration_no='$reg_no'");
    $row = $result->fetch_assoc();
}

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reg_no = $_POST['reg_no'];
    $dept = $_POST['dept'];

    $conn->query("UPDATE student SET name='$name', email='$email', department='$dept' WHERE registration_no='$reg_no'");

    echo "Updated Successfully";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Informations</title>
    </head>
    <body>
        <form method="POST">

            <input type="hidden" name="reg_no" value="<?php echo $row['registration_no']; ?>">

            Name:
            <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>

            Email:
            <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>

            Department:
            <select name="dept">
                <option <?php if($row['department']=="CSE") echo "selected"; ?>>CSE</option>
                <option <?php if($row['department']=="EEE") echo "selected"; ?>>EEE</option>
                <option <?php if($row['department']=="IPE") echo "selected"; ?>>IPE</option>
            </select><br><br>

            <button type="submit" name="update">Update</button>

        </form><br>

        <a href="view.php">Back</a>

    </body>
</html>