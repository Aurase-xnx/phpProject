<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
  if(!isset($_SESSION['loggedin']))
  {
    echo "You need to login first";
    header("Location:profileN.php");
  }

  if (isset($_POST['modify']) ) {
   //un champ obligatoire
   if ( !empty($_POST['firstName']) )
   {
     echo "fn";
      $username = trim($_POST['firstName']) ;
   }
   else
   {
     echo "fn2";
       $mistakes['firstName'] = true;
   }
   if ( !empty($_POST['lastName']) )
   {
      $username = trim($_POST['lastName']) ;
   }
   else
   {
       $mistakes['lastName'] = true;
   }



   if ( !empty($_POST['passmod']) AND isset($_POST['passmodconf'])){
     if ($_POST["passmod"]== $_POST["passmodconf"]) {
       $passmod = trim($_POST['passmod']);
       $passhash = sha1($passmod);
     }
   }
   else
   {
       $mistakes['passmod'] = true;
   }

   //s'il n'y a pas d'erreur...
   if (!empty($mistakes))
   {
       include("db.php");
       echo "sss";
      $req=$bd->prepare('UPDATE  users WHERE id=:id SET (firstName,lastName,password) VALUES (:username,:email,:password)');
      $req->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
      $req->bindValue(':firstNameMod', $firstNameMod, PDO::PARAM_STR);
      $req->bindValue(':lastNameMod', $lastNameMod, PDO::PARAM_STR);
      $req->bindValue(':passmod', $passhash, PDO::PARAM_STR);

      $req->execute();
      $req->closeCursor();
      header("Location:profile.php");
      exit();

   }
   else{
     print_r($mistakes);
   }
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>Username : <strong><?php echo $_SESSION['username'];?></strong></p>
    <p>First name : <strong><?php echo $_SESSION['firstName'];?></strong></p>
    <input type="text" name="firstNameMod" value="First Name" id="firstNameMod">
    <p>Last name : <strong><?php echo $_SESSION['lastName'];?></strong></p>
    <input type="text" name="lastNameMod" value="Last Name" id="lastNameMod">
    <p>Mail address : <strong><?php echo $_SESSION['email'];?></strong></p>
    <input type="password" name="passmod" value="" id="passmod" placeholder="Modify your password">
    <input type="password" name="passmodconf" value="" id="passmodconf" placeholder="Confirm the password">
    <input type='submit' name="modify" value='Modify'>
  </body>
</html>
