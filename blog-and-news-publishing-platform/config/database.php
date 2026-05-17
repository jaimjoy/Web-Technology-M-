<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "blog_platform";

$conn = new mysqli($host, $user, $pass, $database);

if($conn->connect_error)
{
    die("Connection Failed");
}

?>