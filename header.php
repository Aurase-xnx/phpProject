<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Samplitek</title>
    <link rel="icon" type="image/x-icon" href="Custom/Images/favicon.png">
    <link rel="stylesheet" href="Custom/css/styles.css">
  </head>
  <body>
    <header>
      <a class="logo" href="index.php"><img src="Custom/Images/Samplitek.png" alt="c le logo"></a>
      <div class="Links">
        <a href="index.php">Home</a>
        <a href="samples.php">Samples</a>
        <a href="songs.php">Songs</a>


        <?php
        if (isset($_SESSION['rights'])) {
          if($_SESSION['rights']==3)
          {
            echo '<a href="admin.php">Admin</a>';
          }
          if ($_SESSION['rights']==2) {
            echo '<a href="modo.php">Modo</a>';
          }
          if ($_SESSION['rights']==1) {
            echo '<a href="profile.php">Profile</a>';
          }
        }
        else {
          echo '<a href="profile.php">Profile</a>';
        }


        ?>
        <?php if (!isset($_SESSION['username']))
          {
            echo '<a href="login.php">Login</a>';
          } else {
            echo '<a href="logout.php">Logout</a>';
          }
         ?>
      </div>
    </header>
  </body>
</html>
