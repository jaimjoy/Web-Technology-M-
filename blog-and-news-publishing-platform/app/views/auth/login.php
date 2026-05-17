<?php
require_once("../../controllers/AuthController.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
    <body>
        <div class="auth-container">
            <div class="auth-card">

                <h1>Login</h1>
                <p>
                    Welcome back to Blog Portal
                </p>

                <?php
                    if(!empty($error))
                    {
                        echo "<div class='error-message'>";
                        echo $error;
                        echo "</div>";
                    }
                ?>

                <form method="POST">

                    <input type="email" name="email" placeholder="Enter Email" required>

                    <input type="password" name="password" placeholder="Enter Password" required>

                    <button type="submit" name="login"> Login </button>

                </form>

                <br>

                <a href="register.php"> Create New Account </a>

                <br><br>

                <a href="../reader/home.php"> Back To Homepage </a>
            </div>
        </div>
    </body>
</html>