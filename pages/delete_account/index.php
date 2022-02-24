<?php
// core configuration
include_once("../../php/core.php");
include_once("../../php/database.php");
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style-navbar.css">
  <link rel="icon" href="/icons/favicon-3.png" type="image/png">
  <title>MySQL/PHP Practice | Delete Account</title>
</head>
</style>
<body>

<?php include_once "../../php/navbar.php" ?>

<div class="navbutton">
  <p>Are you sure you want to delete your account?</p>
  <div class="deleteconfirmbutton">
    <button onclick="location.href='../../php/delete_account.php'" id="deleteconfirmyes">Yes</button>
    <button id="deleteconfirmno">No</button>
  </div>
</div>

<?php echo $_SESSION["email"]; ?>
<!-- 
<script>
  document.getElementById("deleteconfirmyes").addEventListener("click", deleteAccount);

  function deleteAccount() {
    console.log("deleted account");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
</script> -->

</body>
</html>