<?php

date_default_timezone_set('Europe/Brussels');
$host='localhost';
$dbName='samplitek';
$user='root';
$mdp='';
try {
 $bd=new PDO('mysql:host='.$host.';dbname='.$dbName, $user, $mdp);
 $bd->exec("SET NAMES 'utf8'");
 echo 'connected';
}
catch (Exception $e) {
 echo 'Error connecting to DB';
}
