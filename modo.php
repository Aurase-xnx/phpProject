<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');
?>
<h1>Moderation</h1>
<?php
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
<?php
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

