<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');

  $strSQL = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
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
    <p>Welcome
      <strong>
        <?php echo $_SESSION [username]; ?>
      </strong>
    </p>
  </body>
</html>
