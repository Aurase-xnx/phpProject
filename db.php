<?php

date_default_timezone_set('Europe/Brussels');
$host='localhost';
$dbName='samplitek';
$user='root';
$mdp='';
global $bd;
try {
 $bd=new PDO('mysql:host='.$host.';dbname='.$dbName, $user, $mdp);
 $bd->exec("SET NAMES 'utf8'");
 $bd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
 $bd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 // echo "Connected to DB";
}
catch (Exception $e) {
 echo 'Error connecting to DB';
}
