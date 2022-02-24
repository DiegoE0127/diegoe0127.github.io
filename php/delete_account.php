<?php

// core configuration
include_once("core.php");
include_once("database.php");

var_dump($_SESSION);

$email = $_SESSION["email"];

$sql = "DELETE FROM users_data WHERE user_email='$email'";

if (mysqli_query($mysqli, $sql)) {
  header("location:../php/logout.php");
} else {
  echo "Error deleting record: " . mysqli_error($mysqli);
}

?>