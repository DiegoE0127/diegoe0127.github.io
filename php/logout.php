<?php
// core configuration
include_once("core.php");
include_once("database.php");

session_unset();
session_destroy();

header("location:../pages/home");
?>
