<?php
    session_start();
    require_once(__DIR__ . "/../models/User.php");

    $user = new User();
    $error="";

    if(isset($_POST["register"]))
    {
        $name = trim($_POST["name"]);
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if(empty($name) ||empty($username) ||empty($email) ||empty($password))
        {
            die("All Fields Required");
        }

        $result = $user->register($name, $username, $email, $password);

        if($result)
        {
            echo "Registration Successful";
        }
        else
        {
            echo "Registration Failed";
        }
    }

    if(isset($_POST["login"]))
    {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if(empty($email) || empty($password))
        {
            die("All Fields Required");
        }

        $result = $user->login($email);

        if($result)
        {
            if(password_verify($password,$result["password_hash"]))
            {
                $_SESSION["user_id"] = $result["id"];
                $_SESSION["name"] = $result["name"];
                $_SESSION["role"] = $result["role"];

                if($result["role"] == "reader")
                {
                    header("Location: http://localhost/Spring25-26/WT-M/Code/blog-and-news-publishing-platform/app/views/reader/dashboard.php");
                    exit();
                }
                elseif($result["role"] == "author")
                {
                    header("Location: http://localhost/Spring25-26/WT-M/Code/blog-and-news-publishing-platform/app/views/author/dashboard.php");
                    exit();
                }
                elseif($result["role"] == "editor")
                {
                    header("Location: http://localhost/Spring25-26/WT-M/Code/blog-and-news-publishing-platform/app/views/editor/dashboard.php");
                    exit();
                }
                elseif($result["role"] == "admin")
                {
                    header("Location: http://localhost/Spring25-26/WT-M/Code/blog-and-news-publishing-platform/app/views/admin/dashboard.php");
                    exit();
                }
            }
            else
            {
                $error = "Incorrect Password";
            }
        }
        else
        {
            $error = "Email Not Found";
        }
    }
?>