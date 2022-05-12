<?php
  include_once('header.php');
  include_once('footer.php');
  include_once('db.php');

  $host = 'localhost';
   $dbname = 'samplitek';
   $username = 'root';
   $password = '';
  $dsn = "mysql:host=$host;dbname=$dbname";
  // get all users
  $sql = "SELECT * FROM Users";

  try{
   $pdo = new PDO($dsn, $username, $password);
   $stmt = $pdo->query($sql);

   if($stmt === false){
    die("Error");
   }

  }catch (PDOException $e){
    echo $e->getMessage();
  }
?>
<h1>Welcome Admin</h1>
<h1>Ready to ban some kids ?</h1>
<h1>Users list</h1>
 <table>
   <thead>
     <tr>
       <th>ID</th>
       <th>Name</th>
       <th>Email</th>
       <th>First Name</th>
       <th>Last Name</th>
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
       <td><?php echo htmlspecialchars($row['firstName']); ?></td>
       <td><?php echo htmlspecialchars($row['lastName']); ?></td>
       <td><?php echo htmlspecialchars($row['rights']); ?></td>
       <td><?php echo htmlspecialchars($row['active']); ?></td>
     </tr>
     <?php endwhile; ?>
   </tbody>
 </table>

 <p>To do : Add an easy way to ban kids</p>
