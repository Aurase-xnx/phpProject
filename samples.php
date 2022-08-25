<?php
include_once('header.php');
include_once('footer.php');
include_once('db.php');
if (isset($_SESSION['id'])) {
  $creatorID = $_SESSION['id'];
  ?>
<p>Samples Here</p>
<form action="samples.php" method="post">
    <input type="text" name="sampleName" id="sampleName" required="" placeholder="Sample Name">
    <input type="text" name="genre" id="genre" required="" placeholder="Genre">
    <input type="text" name="instrument" id="instrument" required="" placeholder="Instrument">
    <input readonly type="hidden" name="creatorID" id="creatorID" <?php if (isset($creatorID)) echo 'value="', $creatorID, '"'; ?>>
    <input type="text" name="bpm" id="bpm" required="" placeholder="BPM">
    <input type="submit" name="addSample" placeholder="Upload the sample">
</form>
<?php
} else {
    echo "You are not logged in! Please log in first to upload a sample.";?>

    <p>Samples Here</p>
<?php
}
$sampleName = $genre = $instrument = "";
$bpm = $bpm2 = "";
if (isset($_POST['addSample'])) {
  //un champ obligatoire
  if (!empty($_POST['sampleName'])) {
    $sampleName = trim($_POST['sampleName']);
  } else {
    $mistakes['sampleName'] = true;
  }

  if (!empty($_POST['genre'])) {
    $genre = trim($_POST['genre']);
  } else {
    $mistakes['genre'] = true;
  }

  if (!empty($_POST['instrument'])) {
    $instrument = trim($_POST['instrument']);
  } else {
    $mistakes['instrument'] = true;
  }

  if (!empty($_POST['creatorID'])) {
    $creatorID = trim($_POST['creatorID']);
    $creatorID2 = (int) $creatorID;
  } else {
    $mistakes['creatorID'] = true;
  }

  if (!empty($_POST['bpm'])) {
    $bpm = trim($_POST['bpm']);
    $bpm2 = (int) $bpm;
  } else {
    $mistakes['bpm'] = true;
  }

    header("Location: samples.php");
    $sql = $bd->prepare("INSERT INTO samples (sampleName,genre,instrument,creatorID,bpm) VALUES (:sampleName,:genre,:instrument,:creatorID2,:bpm2)");
    $sql->bindParam(':sampleName', $sampleName, PDO::PARAM_STR, 255);
    $sql->bindParam(':genre', $genre, PDO::PARAM_STR, 255);
    $sql->bindParam(':instrument', $instrument, PDO::PARAM_STR, 255);
    $sql->bindParam(':creatorID2', $creatorID2, PDO::PARAM_INT, 255);
    $sql->bindParam(':bpm2', $bpm2, PDO::PARAM_INT, 255);
    $sql->execute();

    //$sql->debugDumpParams();
    echo "Uploaded";
    //$req->closeCursor();

    exit();
}

$host = 'localhost';
$dbname = 'samplitek';
$usern = 'root';
$passw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
// get all users
$sql = "SELECT `samples`.*, `users`.`username`
FROM `samples` 
	LEFT JOIN `users` ON `samples`.`creatorID` = `users`.`id`;";

try {
  $pdo = new PDO($dsn, $usern, $passw);
  $stmt = $pdo->query($sql);

  if ($stmt === false) {
    die("Error");
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Sample Name</th>
      <th>Genre</th>
      <th>Instrument</th>
      <th>BPM</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
      <tr>
        <td><?php echo htmlspecialchars($row['id']); ?></td>
        <td><?php echo htmlspecialchars($row['sampleName']); ?></td>
        <td><?php echo htmlspecialchars($row['genre']); ?></td>
        <td><?php echo htmlspecialchars($row['instrument']); ?></td>
        <td><?php echo htmlspecialchars($row['bpm']); ?></td>
        <td><?php echo htmlspecialchars($row['username']); ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
