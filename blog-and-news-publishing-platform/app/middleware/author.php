<?php
require_once("auth.php");

if($_SESSION["role"] != "author")
{
    die("Author Access Only");
}

?>