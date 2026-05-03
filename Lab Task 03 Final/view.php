<?php
include 'db.php';
$sql = "SELECT name, email, registration_no, department from student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Records</title>
        <style>
            table 
            {
                border-collapse: collapse;
            }

            th, td 
            {
                padding: 10px 20px;
                border: 1px solid black;
                text-align: center;
            }
    </style>
    </head>

    <body>
        <h2>Student Records</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registration Number</th>
                <th>Department</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "
                            <tr>
                                <td>".$row['name']."</td>
                                <td>".$row['email']."</td>
                                <td>".$row['registration_no']."</td>
                                <td>".$row['department']."</td>
                                <td>
                                    <a href='update.php?reg_no=".$row['registration_no']."'>Update</a>
                                </td>
                                <td>
                                    <a href='delete.php?reg_no=".$row['registration_no']."' onclick='return confirm (\"Are You Sure?\")'>Delete User</a>
                                </td>
                            </tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
            ?>
        </table><br>
        
        <a href="add.php">
            <button type="button">Back</button>
        </a>

    </body>
</html>