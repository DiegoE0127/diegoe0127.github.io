<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
  include("core.php");
  include("database.php");

  // Check if email and password are valid
	$u_email = filter_var($_POST["user_email"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_pswd = filter_var($_POST["user_pswd"], FILTER_SANITIZE_STRING);

	if (empty($u_email)){
		die("Please enter your email");
	}
	if (empty($u_pswd)){
		die("Please enter password");
	}	
  
  // Encryption
  function encryptPass($password) {
		$sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
		$sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
		$method = 'aes-256-cbc';
	
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
	
		$encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
		return $encrypted;
	}

  $u_pswd = encryptPass($u_pswd);

  // Checks if there is an account that matches with the entered email and password
	$result = mysqli_query($mysqli, "SELECT * FROM users_data WHERE user_email='$u_email' AND user_pswd='$u_pswd'");

  // If one exists, signs in the user
  if($result->num_rows != 0) {
    $user_email = $_POST['user_email'];
    $mysqli->query("DELETE FROM sessions WHERE email='$user_email'");
    session_unset();
    session_destroy();
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['email']=$row['user_email'];
    $_SESSION['id']=session_id();
    $_SESSION['logged_in']=true;
    $_SESSION['user_name']=$row['user_name'];
    // echo $home_url."php/users.php?email=".$row['user_email'];
    $url=$home_url."php/users.php?email=".$row['user_email'];
    header("location:$url");   // create my-account.php page for redirection
  }
  else {
  	echo "failed ";
    header("location:../pages/home");
  }
}
?>