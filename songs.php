<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
  if(isset($_SESSION['id'])){
    $creatorID = $_SESSION['id'];
    ?>
<p>Songs Here</p>
<form action="songs.php" method="post">
    <input type="text" name="songName" id="songName" required="" placeholder="Song Name">
    <input type="text" name="genreS" id="genreS" required="" placeholder="Genre">
    <input type="text" name="bpmS" id="bpmS" required="" placeholder="BPM">
    <input readonly type="hidden" name="creatorID" id="creatorID" <?php if (isset($creatorID)) echo 'value="', $creatorID, '"'; ?>>
    <input type="submit" name="addSong" required="Upload the song ">
</form>
<?php
  }else{
      echo "You are not logged in! Please log in first to upload a songs.";?>

        <p>Songs Here</p>
<?php
  }
  $songName = $genreS = "";
  $bpm = "";
  if (isset($_POST['addSong']) ) {
   //un champ obligatoire
   if (!empty($_POST['songName']) ){
       $songName = trim($_POST['songName']) ;}
   else{
       $mistakes['songName'] = true;}

   if ( !empty($_POST['genreS'])){
       $genreS = trim($_POST['genreS']) ;}
   else
   {
       $mistakes['genreS'] = true;}

   if ( !empty($_POST['bpmS'])){
       $bpmS = trim($_POST['bpmS']) ;}
   else
   {
       $mistakes['bpmS'] = true;}

  if (!empty($_POST['creatorID'])) {
      $creatorID = trim($_POST['creatorID']);
      $creatorID2 = (int) $creatorID;
  } else {
      $mistakes['creatorID'] = true;
  }
      header("Location: songs.php");
      $sql= $bd->prepare('INSERT INTO  songs (songName,genre,bpm,creatorID) VALUES (:songName,:genreS,:bpmS,:creatorID2)');
      $sql->bindParam(':songName', $songName, PDO::PARAM_STR,255);
      $sql->bindParam(':genreS', $genreS, PDO::PARAM_STR, 255);
      $sql->bindParam(':bpmS', $bpmS, PDO::PARAM_INT, 255);
      $sql->bindParam(':creatorID2', $creatorID2, PDO::PARAM_INT, 255);
      $sql->execute();

      //$sql->debugDumpParams();
      //echo "Ok";
      exit();

   }


  $host = 'localhost';
   $dbname = 'samplitek';
   $usern = 'root';
   $passw = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  // get all users
  $sql = "SELECT `songs`.*, `users`.`username`
FROM `songs` 
	LEFT JOIN `users` ON `songs`.`creatorID` = `users`.`id`";

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

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Song Name</th>
      <th>Genre</th>
      <th>BPM</th>
      <th>username</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <tr>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['songName']); ?></td>
      <td><?php echo htmlspecialchars($row['genre']); ?></td>
      <td><?php echo htmlspecialchars($row['bpm']); ?></td>
      <td><?php echo htmlspecialchars($row['username']); ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
