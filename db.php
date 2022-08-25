<?php

date_default_timezone_set('Europe/Brussels');
$host='localhost';
$dbName='samplitek';
$user='root';
$mdp='';
try {
 $bd=new PDO('mysql:host='.$host.';dbname='.$dbName, $user, $mdp, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
 $bd->exec("SET NAMES 'utf8'");
 // echo "Connected to DB";
}
catch (Exception $e) {
 echo 'Error connecting to DB';
}
