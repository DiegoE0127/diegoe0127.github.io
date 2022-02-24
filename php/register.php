<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

	//mysql credentials
	$mysql_host = "localhost";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "test";
	
	$u_name = filter_var($_POST["user_name"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$u_email = filter_var($_POST["user_email"], FILTER_SANITIZE_EMAIL);
	$u_pswd = filter_var($_POST["user_pswd"], FILTER_SANITIZE_STRING);

	if (empty($u_name)){
		die("Please enter your name");
	}
	if (empty($u_email) || !filter_var($u_email, FILTER_VALIDATE_EMAIL)){
		die("Please enter valid email address");
	}
	if (empty($u_pswd)){
		die("Please enter password");
	}	

	//Open a new connection to the MySQL server
	//see https://www.sanwebe.com/2013/03/basic-php-mysqli-usage for more info
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	//Output any connection error
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	

	function encryptPass($password) {
		$sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
		$sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
		$method = 'aes-256-cbc';
	
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
	
		$encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
		return $encrypted;
	}

	// Generate auth code
	function generateRandomString($length = 6) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	$authCode = generateRandomString();

	$statement = $mysqli->prepare("INSERT INTO users_data (user_name, user_email, user_pswd, user_authcode) VALUES(?, ?, ?, ?)"); //prepare sql insert query
	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('ssss', $u_name, $u_email, encryptPass($u_pswd), $authCode); //bind values and execute insert query
	
	if($statement->execute()){
		echo "Hello " . $u_name . "!, your message has been saved!";
    // header("location:../pages/account_page");

	// Email + Auth Code
	$to = "diego.escobar0127@gmail.com";
  	$subject = "Authentication Code";
  	$txt = "http://172.16.0.33:8080/test_project/php/authenticate.php?code=" . $authCode . "&email=" . $to;
  	$headers = "From: diego.escobar0127@gmail.com";
  	mail($to,$subject,$txt,$headers);

	// Redirect to auth page
	header("location:../pages/authenticate");
	}else{
		echo $mysqli->error; //show mysql error if any
    header("location:../pages/signin");
	}
}
?>