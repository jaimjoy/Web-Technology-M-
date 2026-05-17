<?php
require_once("../../controllers/AuthController.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link
        rel="stylesheet"
        href="../../../assets/css/style.css"
    >
</head>
    <body>
        <div class="auth-container">

            <div class="auth-card">

                <h1>Create Account</h1>

                <p>
                    Join the Blog Portal community
                </p>

                <form method="POST">

                    <input type="text" name="name" placeholder="Enter Full Name" required>

                    <input type="text" name="username" placeholder="Enter Username" required>

                    <input type="email" name="email" placeholder="Enter Email" required>

                    <input type="password" name="password" placeholder="Enter Password" required>

                    <button type="submit" name="register"> Register </button>
                </form>

                <br>

                <a href="login.php"> Already Have An Account? </a>

                <br><br>

                <a href="../reader/home.php"> Back To Homepage </a>
                
            </div>
        </div>
    </body>
</html>