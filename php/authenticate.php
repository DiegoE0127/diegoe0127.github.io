<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
  include("core.php");
  include("database.php");

  $code = filter_var($_POST["authcode"], FILTER_SANITIZE_STRING);

  // let url = document.URL;
  // var arr = url.split("?");
  // arr = arr[arr.length - 1];
  // arr = arr.split("&");
  // const code = arr[arr.length - 2];
  // const email = arr[arr.length - 1];
  // if (code === code) {
  //   console.log(code);
  // }
  // if (email === email) {
  //   console.log(email);
  // }
    
  // $arr = $_SERVER['PATH_INFO'];
  // echo $arr;
  
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "test";
  $mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);


  // $doc = new DomDocument;
  // // We need to validate our document before referring to the id
  // $code = $doc->getElementById('authcode');

  $result = $mysqli->query("SELECT * FROM users_data WHERE user_authcode = '$code'");

  // If code is found with matching user, then return user
  if($result->num_rows === 0) {
    $output = "row not found";
  } else {
    $output = "row found";
    while($row = $result->fetch_assoc()) {
      $user_email = $row["user_email"];
      $user_authcode = $row["user_authcode"];
      $user_name = $row['user_name'];
      $output = "<br> code: ". $row["user_authcode"]. " - Email: ". $row["user_email"]. " " . "<br>";
    }
    $result = mysqli_query($mysqli, "SELECT * FROM users_data WHERE user_email='$u_email' AND user_authcode='$user_authcode'");
    $mysqli->query("DELETE FROM sessions WHERE email='$user_email'");
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['email']=$user_email;
    $_SESSION['id']=session_id();
    $_SESSION['logged_in']=true;
    $_SESSION['user_name']=$user_name;
    // echo $home_url."php/users.php?email=".$row['user_email'];
    $url=$home_url."pages/home";
    header("location:$url");   // create my-account.php page for redirection
  }
  $mysqli->close();
}
?>