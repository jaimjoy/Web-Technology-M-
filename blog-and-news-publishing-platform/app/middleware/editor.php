<?php
require_once("auth.php");

if($_SESSION["role"] != "editor")
{
    die("Editor Access Only");
}

?>