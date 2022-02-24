<?php
// core configuration
include_once("../../php/core.php");
include_once("../../php/database.php");
?>

<!-- comment test checking if vscode is connected to github -->

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style-navbar.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="../../icons/favicon.ico" type="image/x-icon">
  <title>MySQL/PHP Practice | Account Settings</title>
</head>
<style>
  * {
  box-sizing: border-box;
}

.sidebar {
  width: 20%;
  border-radius: 15px;
  position: fixed;
  z-index: 1;
  left: 17%;
  background: #444;
  overflow-x: hidden;
  padding: 8px 0;
  text-align: center;
}

.sidebar a {
  color: white;
  text-align: center;
}

.sidebar a:hover {
  color: #777;
}

.sidebar-items a {
  margin-bottom: 4%;
  line-height: 60px;
  text-decoration: none;
}

.center {
  width: 45%;
  height: 80%;
  border-radius: 15px;
  position: fixed;
  z-index: 1;
  left: 38%;
  background: #444;
  overflow-x: hidden;
  padding: 8px 0;
  text-align: center;
  color: white;
  font-size: 30px;
  display: none;
  flex-direction: column;
}

.general {
  display: inline;
}

.account-information {
  text-align: left;
  padding-top: 1%;
  padding-left: 3%;
}

.edit {
  background-color: #0078a1;
  color: white;
  border-radius: 70px;
  padding: 1px 12px;
  font-size: 20px;
  border: 0;
}

.edit:hover {
  background-color: #004a63;
}

.edit-cancel {
  background-color: #a10000;
  color: white;
  border-radius: 70px;
  padding: 1px 12px;
  font-size: 20px;
  border: 0;
  display: none;
}

.edit-cancel:hover {
  background-color: #6b0000;
}

.edit-username, .edit-email, .edit-password {
  display: none;
}

.input-new-username, .input-new-email, .input-new-password {
  background-color: #8a8a8a;
  color: white;
  font-size: 30px;
  border-radius: 70px;
  border: 0;
  width: 20%;
  text-align: center;
  border: 0;
}

.submit-new-username, .submit-new-email, .submit-new-password {
  background-color: #0078a1;
  color: white;
  border-radius: 70px;
  padding: 1px 12px;
  font-size: 20px;
  border: 0;
}

.customize-header {
  text-align: center;
}

.customize-info {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

.pfp-edit {
  width: 50%;
  height: 50%;
  border-radius: 5px;
  position: fixed;
  z-index: 1;
  left: 30%;
  top: 30%;
  background: #777;
  overflow-x: hidden;
  padding: 8px 0;
  text-align: center;
  color: white;
  font-size: 20px;
  display: none;
}

.pfp-container {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}

.pfp {
  display: block;
  float: left;
  margin: auto;
  width: 100px;
  height: 100px;
}

.overlay {
  position: absolute;
  /* left: 26.7vh; */
  height: 100px;
  width: 100px;
  opacity: 0;
  transition: .2s ease;
  background-color: #008CBA;
}

.pfp-container:hover .overlay {
  opacity: 0.8;
}

.text {
  color: white;
  font-size: 14px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

.pfp-button {
  opacity: 1;
}

.column {
  float: left;
  width: 50%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

@media only screen and (max-width: 600px) and (min-width: 0px) {
  .sidebar a {
    font-size: 14px;
  }
}

@media only screen and (min-width: 601px) {
  .sidebar a {
    font-size: 22px;
  }
}
</style>
<script>
window.onload = function(){
  settingEventListeners();

};

function settingEventListeners() {
  document.getElementById("button-general").addEventListener("click", showGeneral);
  document.getElementById("button-security").addEventListener("click", showSecurity);
  document.getElementById("button-customize").addEventListener("click", showCustomize);
  document.getElementById("button-edit-username").addEventListener("click", showEditUsername);
  document.getElementById("button-edit-username-cancel").addEventListener("click", cancelEditUsername);
  document.getElementById("button-edit-email").addEventListener("click", showEditEmail);
  document.getElementById("button-edit-email-cancel").addEventListener("click", cancelEditEmail);
  document.getElementById("button-edit-password").addEventListener("click", showEditPassword);
  document.getElementById("button-edit-password-cancel").addEventListener("click", cancelEditPassword);
  // document.getElementById("pfp-container").addEventListener("click", editPfp);
}

function pfpOverlayPosition() {
  var pfpRect = document.getElementById("pfp").getBoundingClientRect();
  console.log("left, innerwidth");
  console.log(pfpRect.left, window.innerWidth);
  // var overlayOffsetLeft = 0;
  // Left coord of pfp element - (width of window * )
  var overlayOffsetLeft = pfpRect.left - Math.floor(window.innerWidth * .38);
  console.log("overlayoffset:" + overlayOffsetLeft);
  document.getElementById('pfp-overlay').style.top = "88";
  document.getElementById('pfp-overlay').style.left = overlayOffsetLeft + "px";
}

function showGeneral() {
  hideSettings();
  console.log("general");
  document.getElementById('general').style.display = 'inline';
}
function showSecurity() {
  hideSettings();
  document.getElementById('security').style.display = 'inline';
}
function showCustomize() {
  hideSettings();
  document.getElementById('customize').style.display = 'flex';
  pfpOverlayPosition();
}
function hideSettings() {
  document.getElementById('general').style.display = 'none';
  document.getElementById('security').style.display = 'none';
  document.getElementById('customize').style.display = 'none';
}
// function editPfp() {
//   console.log("pfp");
//   document.getElementById('pfp-edit').style.display = 'inline';
// }

function showEditUsername() {
  document.getElementById('username').style.display = 'none';
  document.getElementById('edit-username').style.display = 'inline';
  document.getElementById('button-edit-username').style.display = 'none';
  document.getElementById('button-edit-username-cancel').style.display = 'inline';
}
function cancelEditUsername() {
  document.getElementById('username').style.display = 'inline';
  document.getElementById('edit-username').style.display = 'none';
  document.getElementById('button-edit-username').style.display = 'inline';
  document.getElementById('button-edit-username-cancel').style.display = 'none';
}

function showEditEmail() {
  document.getElementById('email').style.display = 'none';
  document.getElementById('edit-email').style.display = 'inline';
  document.getElementById('button-edit-email').style.display = 'none';
  document.getElementById('button-edit-email-cancel').style.display = 'inline';
}
function cancelEditEmail() {
  document.getElementById('email').style.display = 'inline';
  document.getElementById('edit-email').style.display = 'none';
  document.getElementById('button-edit-email').style.display = 'inline';
  document.getElementById('button-edit-email-cancel').style.display = 'none';
}

function showEditPassword() {
  document.getElementById('password').style.display = 'none';
  document.getElementById('edit-password').style.display = 'inline';
  document.getElementById('button-edit-password').style.display = 'none';
  document.getElementById('button-edit-password-cancel').style.display = 'inline';
}
function cancelEditPassword() {
  document.getElementById('password').style.display = 'inline';
  document.getElementById('edit-password').style.display = 'none';
  document.getElementById('button-edit-password').style.display = 'inline';
  document.getElementById('button-edit-password-cancel').style.display = 'none';
}

// function uploadPfpImage() {
//   const openFileDialog = () => {
//   document.getElementById("fileDialogId").click();
// };
// setTimeout(openFileDialog, 0);
// }

</script>
<body>

<?php include_once "../../php/navbar.php" ?>

<h2> Account Settings </h2>

<!-- <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
  <h3 class="w3-bar-item">Menu</h3>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div> -->

<div class="sidebar">
  <a id="button-general">General</a></br>
  <a id="button-security">Security</a></br>
  <a id="button-customize">Customize</a>
</div>

<div id="general" class="center general">
  <div class="account-information">
    <div>
      Username: <a id="username"><?php echo $_SESSION["user_name"] ?></a>
      <form method="post" id="edit-username" class="edit-username" action="../../php/edit_username.php">
        <input type="text" class="input-new-username" id="input-new-username" name="input-new-username">
        <input type=submit class="submit-new-username">
      </form>
      <button id="button-edit-username" class="edit">Edit</button>
      <button id="button-edit-username-cancel" class="edit-cancel">Cancel</button>
      </br>
    </div>
    Password: <a id="password">*******</a>
      <form method="post" id="edit-password" class="edit-password" action="../../php/edit_password.php">
        <input type="password" class="input-new-password" id="input-new-password" name="input-new-password">
        <input type=submit class="submit-new-password">
      </form>
      <button id="button-edit-password" class="edit">Edit</button>
      <button id="button-edit-password-cancel" class="edit-cancel">Cancel</button>
      </br>
    Email: <a id="email"><?php echo $_SESSION["email"] ?></a>
      <form method="post" id="edit-email" class="edit-email" action="../../php/edit_email.php">
        <input type="text" class="input-new-email" id="input-new-email" name="input-new-email">
        <input type=submit class="submit-new-email">
      </form>
      <button id="button-edit-email" class="edit">Edit</button>
      <button id="button-edit-email-cancel" class="edit-cancel">Cancel</button>
      </br>
      <!-- <?php var_dump($_SESSION); ?> -->
  </div>
</div>

<div id="security" class="center security">
  This is a different div
</div>


<div id="customize" class="center customize">
  <div id="customize-header">
  This is the customize tab</br>
  Profile Picture</br>
  </div>
  <div id="customize-info">
    <!-- Profile Picture -->
    <div id="pfp-container" class="pfp-container" >
      <img id="pfp" class="pfp" src="..\..\img\avatar_placeholder.png">
      <div id="pfp-overlay" class="overlay">
        <div class="text">Edit Profile Picture</div>
      </div>
    </div>
    <!-- Other Information -->
    <div>
        other information
    </div>
  </div>
</div>

<div id="pfp-edit" class="pfp-edit">
  <a class="pfp-button">Hello there<a></br>
  <form method="post" action="../../php/upload_pfp.php">
    <input type="file" id="myFile" name="filename">
    <input type="submit">
  </form>
  <!-- <form style="display:inline">
    <input type="file" id="fileDialogId" />
    <button id="pfp-upload" class="pfp-button" onclick="uploadPfpImage()">Upload Image</button>
  </form> -->
</div>

</body>
</html>