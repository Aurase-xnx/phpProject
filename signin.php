<?php
session_start();
if ( isset($_POST['completed']) ) {
 //un champ obligatoire
 if ( !empty($_POST['username']) )
 {
    $username = trim($_POST['username']) ;
 }
 else
 {
     $mistakes['username'] = true;
 }


 if ( !empty($_POST['password']) )
 {
    $password = trim($_POST['password']) ;
 }
 else
 {
     $mistakes['password'] = true;
 }





 //un champ obligatoire avec certaines valeurs rejetées




 //s'il n'y a pas d'erreur...
 if (empty($mistakes))
 {
     include("db.php");

    $req=$bd->prepare("INSERT INTO  `users` (`username`,`password`) VALUES (:username,:password)");
    $req->bindValue(':username', $requsername, PDO::PARAM_STR);
    $req->bindValue(':password', $reqpasshash, PDO::PARAM_STR);
    $requsername = $username;
    $reqpasshash = $password;

    $req->execute();
    $req->closeCursor();
    header("Location: index.php");
    exit();



 }
 else{
   print_r($mistakes);
 }
}

?>
<!DOCTYPE html>
<?php
  include_once('header.php');
 ?>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
    <title>Samplitek</title>
    <link rel="icon" type="image/x-icon" href="Custom/Images/favicon.png">
    <link rel="stylesheet" href="Custom/css/login.css">
  </head>
  <body>

    <form method="post" class='login-form' action="signin.php">

    <div class="flex-row">
      <label class="lf--label" for="username">
        <svg x="0px" y="0px" width="12px" height="13px">
          <path fill="#B1B7C4" d="M8.9,7.2C9,6.9,9,6.7,9,6.5v-4C9,1.1,7.9,0,6.5,0h-1C4.1,0,3,1.1,3,2.5v4c0,0.2,0,0.4,0.1,0.7 C1.3,7.8,0,9.5,0,11.5V13h12v-1.5C12,9.5,10.7,7.8,8.9,7.2z M4,2.5C4,1.7,4.7,1,5.5,1h1C7.3,1,8,1.7,8,2.5v4c0,0.2,0,0.4-0.1,0.6 l0.1,0L7.9,7.3C7.6,7.8,7.1,8.2,6.5,8.2h-1c-0.6,0-1.1-0.4-1.4-0.9L4.1,7.1l0.1,0C4,6.9,4,6.7,4,6.5V2.5z M11,12H1v-0.5 c0-1.6,1-2.9,2.4-3.4c0.5,0.7,1.2,1.1,2.1,1.1h1c0.8,0,1.6-0.4,2.1-1.1C10,8.5,11,9.9,11,11.5V12z"/>
        </svg>
      </label>
      <input id="username" name="username" class='lf--input' placeholder='Username' type='text'
      <?php if(isset($username)) echo 'value="',$username,'"';?>>
    </div>

  <div class="flex-row">
    <label class="lf--label" for="password">
      <svg x="0px" y="0px" width="15px" height="5px">
        <g>
          <path fill="#B1B7C4" d="M6,2L6,2c0-1.1-1-2-2.1-2H2.1C1,0,0,0.9,0,2.1v0.8C0,4.1,1,5,2.1,5h1.7C5,5,6,4.1,6,2.9V3h5v1h1V3h1v2h1V3h1 V2H6z M5.1,2.9c0,0.7-0.6,1.2-1.3,1.2H2.1c-0.7,0-1.3-0.6-1.3-1.2V2.1c0-0.7,0.6-1.2,1.3-1.2h1.7c0.7,0,1.3,0.6,1.3,1.2V2.9z"/>
        </g>
      </svg>
    </label>
    <input id="password" name="password" class='lf--input' placeholder='Password' type='password'
    <?php if(isset($password)) echo 'value="',$password,'"';?>>
  </div>

  <input class='lf--submit' type='submit' name="completed" value='SIGN IN'>
</form>
<div class="plusplus">
  <a class='lf--forgot' href='#forgeti'>Forgot password?</a>
  <a href="login.php">Already have an account? Log In !</a>
</div>


  </body>
</html>
