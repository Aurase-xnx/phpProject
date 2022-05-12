<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
  if(isset($_SESSION['id']))
  {
    $creatorID = $_SESSION['id'];
  }
  $songName = $genreS = $bpm = "";
  if (!isset($_POST['addSong']) ) {
   //un champ obligatoire
   if ( !empty($_POST['songName']) )
   {
      $songName = trim($_POST['songName']) ;
   }
   else
   {
       $mistakes['songName'] = true;
   }

   if ( !empty($_POST['genreS'])){
       $genreSS = trim($_POST['genreS']) ;
   }
   else
   {
       $mistakes['genreS'] = true;
   }

   if ( !empty($_POST['bpmS'])){
       $bpmS = trim($_POST['bpmS']) ;
   }
   else
   {
       $mistakes['bpmS'] = true;
   }

   //s'il n'y a pas d'erreur...
   if (empty($mistakes))
   {
       include("db.php");

      $req=$bd->prepare('INSERT INTO  songs (songName,genre,bpm,creatorID) VALUES (:songName,:genre,:bpm,:creatorID)');
      $req->bindParam(':songName', $songName, PDO::PARAM_STR);
      $req->bindParam(':genre', $genreS, PDO::PARAM_STR);
      $req->bindParam(':bpm', $bpmS, PDO::PARAM_STR);
      $req->bindParam(':creatorID', $creatorID, PDO::PARAM_STR);
      $req->execute();
      $req->closeCursor();
      header("Location:songs.php");
      exit();

   }
   else{
     print_r($mistakes);
   }
  }

  $host = 'localhost';
   $dbname = 'samplitek';
   $usern = 'root';
   $passw = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  // get all users
  $sql = "SELECT * FROM songs";

  try{
   $pdo = new PDO($dsn, $usern, $passw);
   $stmt = $pdo->query($sql);

   if($stmt === false){
    die("Error");
   }

  }catch (PDOException $e){
    echo $e->getMessage();
  }

 ?>
<p>Songs Here</p>
<form action="songs.php" method="post">
  <input type="text" name="songName" id="songName" required="" placeholder="Song Name">
  <input type="text" name="genreS" id="genreS" required="" placeholder="Genre">
  <input type="text" name="bpms" id="bpmS" required="" placeholder="BPM">
  <input type="submit" name="addSong" required="Upload the song ">
</form>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Song Name</th>
      <th>Genre</th>
      <th>BPM</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['songName']); ?></td>
      <td><?php echo htmlspecialchars($row['genre']); ?></td>
      <td><?php echo htmlspecialchars($row['bpm']); ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
