<div class="navbar-fill">
  <div class="dropdown" style="float:left;">
    <button onclick="location.href='../home'" class="dropbtn">Home</button>
  </div>
  <div class="dropdown" style="float:right;">
    <?php
      // Checks if a user is logged in
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true) {
    ?>
      <button class="dropbtn">
        <?php 
        if (isset($_SESSION['user_name'])) {
          echo $_SESSION['user_name'];
        }
        else {
          echo $_SESSION['email'];
        } 
        ?>
        </button>
        <div class="dropdown-content">
          <a href="../account_page">Account Settings</a>
          <a href="../../php/logout.php">Log Out</a>
        </div>
    <?php
      } else {
    ?>
      <button onclick="location.href='../signin'" class="dropbtn">Sign In / Register</button>
    <?php
      }
    ?>
  </div>
</div>