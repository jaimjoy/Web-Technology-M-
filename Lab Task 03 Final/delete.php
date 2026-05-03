<?php
include 'db.php';

if(isset($_GET['reg_no']))
{
    $reg_no = $_GET['reg_no'];
    $sql = "DELETE FROM student WHERE registration_no='$reg_no'";

    if($conn->query($sql) === TRUE)
    {
        echo "Student Deleted Successfully";
    }
    else
    {
        echo "Error deleting record: " . $conn->error;
    }
}

echo "<br><a href='view.php'>Back</a>";

?>