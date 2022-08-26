<?php
  include_once('header.php');
  include_once('db.php');
?>
<h1>Administration</h1>
<h1>Welcome Admin</h1>

<?php
if ($_SESSION['rights']=="3")
{
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

    <!--DELETE SAMPLE-->
    <p>Sample to delete?(input the id)</p>
    <form action="admin.php" method="post">
        <input type="text" name="sampleID" id="sampleID" placeholder="Sample ID">
        <input type="submit" name="deleteSample" placeholder="Delete the sample">
    </form>

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

    try {
        $pdo = new PDO($dsn, $usern, $passw);
        $stmt = $pdo->query($sql);

        if ($stmt === false) {
            die("Error");
        }
    }

    catch (PDOException $e){
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
    <p>Song to delete?(input the id)</p>
    <form action="admin.php" method="post">
        <input type="text" name="songID" id="songID" placeholder="Song ID">
        <input type="submit" name="deleteSong" placeholder="Delete the song">
    </form>
    <?php

    if (isset($_POST['deleteSample'])){
        if (!empty($_POST['sampleID'])){
            header("Location: admin.php");
            $sampleId = trim($_POST['sampleID']);
            print_r($sampleId);
            $stmt = $bd->prepare("DELETE FROM samples WHERE id=:sampleId");
            $stmt->bindParam(':sampleId', $sampleId);
            $stmt->execute();
            exit();
        }
    }
    if (isset($_POST['deleteSong'])){
        if (!empty($_POST['songID'])){
            header("Location: admin.php");
            $songId = trim($_POST['songID']);
            print_r($songId);
            $stmt = $bd->prepare("DELETE FROM songs WHERE id=:songId");
            $stmt->bindParam(':songId', $songId);
            $stmt->execute();
            exit();
        }

    }

}
else{
    echo "Trying to be clever boy ?";
}
?>


<?php
$host = 'localhost';
$dbname = 'samplitek';
$usern = 'root';
$passw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
// get all users
$sql = "SELECT `users`.*
FROM `users`;";

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
<h1>Users list</h1>
 <table>
   <thead>
     <tr>
       <th>ID</th>
       <th>Name</th>
       <th>Email</th>
       <th>Rights</th>
       <th>Not banned yet</th>
     </tr>
   </thead>
   <tbody>
     <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
     <tr>
       <td><?php echo htmlspecialchars($row['id']); ?></td>
       <td><?php echo htmlspecialchars($row['username']); ?></td>
       <td><?php echo htmlspecialchars($row['email']); ?></td>
       <td><?php echo htmlspecialchars($row['rights']); ?></td>
       <td><?php echo htmlspecialchars($row['active']); ?></td>
     </tr>
     <?php endwhile; ?>
   </tbody>
 </table>
<p>User to delete?(input the id)</p>
<form action="admin.php" method="post">
    <input type="text" name="userID" id="userID" placeholder="User ID">
    <input type="submit" name="deleteUser" placeholder="Delete the User">
</form>
<?php
if (isset($_POST['deleteUser'])){
    if (!empty($_POST['userID'])){
        $userId = trim($_POST['userID']);
        print_r($userId);
        $stmt = $bd->prepare("DELETE FROM users WHERE id=:userId");
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        header("Location: admin.php");
        exit();
    }
}
?>
<p>Who should be the next modo or admin? (input the id and "2" for Modo, "3" for admin)</p>
<form action="admin.php" method="post">
    <input type="text" name="userID" id="userID" placeholder="User ID">
    <input type="text" name="userRIGHTS" id="userRIGHTS" placeholder="User Rights">
    <input type="submit" name="modRightsUser" placeholder="Give new rights to users">
</form>
<?php
if (isset($_POST['modRightsUser'])){
    if (!empty($_POST['userID']) and !empty($_POST['userRIGHTS'])){
        $userId = trim($_POST['userID']);
        $userRights = trim($_POST['userRIGHTS']);
        $stmt = $bd->prepare("UPDATE users SET rights=:userRights WHERE id=:userId");
        $stmt->bindParam(':userRights', $userRights);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        exit();
    }
}
?>
