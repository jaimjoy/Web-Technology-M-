<?php
require_once("auth.php");

if($_SESSION["role"] != "reader")
{
    die("Reader Access Only");
}

?>