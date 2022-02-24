<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    include("core.php");
    include("database.php");

    $new_password = filter_var($_POST["input-new-password"], FILTER_SANITIZE_STRING);

    // Encrypt password
    function encryptPass($password) {
		$sSalt = '20adeb83e85f03cfc84d0fb7e5f4d290';
		$sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
		$method = 'aes-256-cbc';
	
		$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
	
		$encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
		return $encrypted;
	}

    $new_password = encryptPass($new_password);

    // Change information in database
    $u_email = $_SESSION["email"];
    $mysqli->query("UPDATE users_data SET user_pswd = '$new_password' WHERE user_email='$u_email'");
    
    // Change information in SESSIONS
    $url=$home_url."pages/account_page";
    header("location:$url");

    $mysqli->close();
}
?>