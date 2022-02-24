<?php
include_once("core.php");
include_once("database.php");
if(isset($_GET['email'])) {
  print_r($_SESSION['id']);
  if(isset($_SESSION['id'])) {
    print_r("pass");
    $query = "SELECT * FROM sessions WHERE session_id='".$_SESSION['id']."'";
    $result = $mysqli->query($query);
    if($result->num_rows > 0) {
      $row=$result->fetch_row();
      $current_time=date("h:i");
      if($current_time>$row[3]) {
        $mysqli->query("DELETE FROM sessions WHERE session_id='".$_SESSION['id']."'");
        die("Your session is expired");
      }
      $email = $row[0];
      $result = $mysqli->query("SELECT * from users where email='$email'");
      $row=$result->fetch_assoc();
      header("location:../pages/account_page.html");
    }
    else {
      $query = "SELECT user_email FROM users_data WHERE user_email='".$_GET['email']."'";
      //$query="Select * from users where email='fahmida@gmail.com' and password='111111'";
      $result = $mysqli->query($query);
      $row=$result->fetch_assoc();
      $login_time=date("h:i");
      echo $_GET['email'];
      $expired_time = date("h:i", strtotime('+30 minutes', strtotime("now")));
      $insqry="UPDATE sessions SET email='".$_GET['email']."', session_id='".$_SESSION['id']."', login_time='$login_time', session_expire='$expired_time'";
      $result = $mysqli->query($insqry);
      header("location:../pages/account_page");
    }
  }
  else {
    die ("Your session is expired");
  }
}
else {
  echo "<center><h2>You are not logged in or your session is expired</h2></center>";
}
?>