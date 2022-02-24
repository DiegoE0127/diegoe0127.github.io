<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    include("core.php");
    include("database.php");

    $new_username = filter_var($_POST["input-new-username"], FILTER_SANITIZE_STRING);
    echo $new_username;

    // Change information in database
    $u_email = $_SESSION["email"];
    $mysqli->query("UPDATE users_data SET user_name = '$new_username' WHERE email='$u_email'");
    
    // Change information in SESSIONS
    $_SESSION['user_name']=$new_username;
    $url=$home_url."pages/account_page";
    header("location:$url");

    $mysqli->close();
}
?>