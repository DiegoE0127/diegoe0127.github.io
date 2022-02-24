<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form
    include("core.php");
    include("database.php");

    $image = $_POST;

    return $image;
}
?>