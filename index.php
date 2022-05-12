<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
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
        <?php
        if (isset($_SESSION['username'])){echo $_SESSION['username'];}
        else {}
        ?>
      </strong>
    </p>
    <p>This is your new favorite website</p>
  </body>
</html>
