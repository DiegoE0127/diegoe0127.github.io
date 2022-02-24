<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    include("core.php");
    include("database.php");

    $new_email = filter_var($_POST["input-new-email"], FILTER_SANITIZE_STRING);

    // Change information in database
    $u_email = $_SESSION["email"];
    $mysqli->query("UPDATE users_data SET user_email = '$new_email' WHERE user_email='$u_email'");
    
    // Change information in SESSIONS
    $_SESSION['email']=$new_email;
    $url=$home_url."pages/account_page";
    header("location:$url");

    $mysqli->close();
}
?>