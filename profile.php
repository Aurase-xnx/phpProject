<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
  if(!isset($_SESSION['id']))
  {
    echo "You need to login first";
    header("Location:profileN.php");
  }
  else{
      $id = $_SESSION['id'];
  }
    $passhash = "";
  if (isset($_POST['modify'])) {
      echo "prout";
      $id = $_SESSION['id'];
   //un champ obligatoire
     if ($_POST["passmod"]== $_POST["passmodconf"]) {
       $passmod = trim($_POST['passmod']);
       $passhash = sha1($passmod);
       echo "ok";
         $datamod = [
             'passhash' => $passhash,
         ];
         echo $passhash;
         $stmt= $bd->prepare("UPDATE users SET password=:pass WHERE id=:id");
         $stmt->bindParam(':pass',$passhash,PDO::PARAM_STR);
         $stmt->bindParam(':id',$_SESSION['id'],PDO::PARAM_STR);
         $stmt->execute();
         exit();
     }
   }

   //s'il n'y a pas d'erreur...



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <form action="profile.php" method="post">
    <p>Username : <strong><?php echo $_SESSION['username'];?></strong></p>
    <p>Mail address : <strong><?php echo $_SESSION['email'];?></strong></p>
    <input type="password" name="passmod" required="" value="" id="passmod" placeholder="Modify your password">
    <input type="password" name="passmodconf" required="" value="" id="passmodconf" placeholder="Confirm the password">
    <input type='submit' name="modify" value='Modify' required="modify">
  </form>
  </body>
</html>
