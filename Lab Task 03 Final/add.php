<?php
include 'db.php';

$success = $error = "";

if(isset($_GET['success']))
{
    $success = "Registration Successful";
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reg = $_POST['reg_no'];
    $dept = $_POST['dept'];

    $sql = "INSERT INTO student (name, email, registration_no, department) VALUES ('$name', '$email', '$reg', '$dept')";

    if($conn->query($sql) === TRUE)
    {
        header("Location: add.php?success=1");
        exit();
    }
    else
    {
        $error = "Error, Failed to register! " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
    <title>Add Student</title>
    <body>
        <h2>Add Student</h2>
        <form method = "POST">
            Name: <input type="text" name="name" required><br><br>
            Email: <input type="email" name="email" required><br><br>
            Registration Number: <input type="number" name="reg_no" required><br><br>
            Department: 
            <select name="dept">
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="IPE">IPE</option>
            </select><br><br>

            <input type="submit" name="submit" value="Add Student">
        </form><br>
        
        <p style="color:green;"><?php echo $success; ?></p>
        <p style="color:red;"><?php echo $error; ?></p>
        
        <a href="view.php">View Students</a>
    </body>
</html>