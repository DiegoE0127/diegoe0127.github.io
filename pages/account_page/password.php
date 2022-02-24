<?php
include("../../php/database.php");

$user_name = $_SESSION['user_name'];
$result = mysqli_query($mysqli, "SELECT * FROM users_data WHERE user_name =".$user_name);
echo $result;
if($result->num_rows === 0) {
    $output = "row not found";
  } else {
    $output = "row found";
  }
$mysqli->close();
?>