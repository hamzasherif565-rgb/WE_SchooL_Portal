
<?php

$HostName ="localhost";
$UserName ="root";
$Password ="";
$DataBaseName ="we_school";

$DNS ="mysql:host=$HostName;dbname=$DataBaseName";


try {
    $Connect = new PDO($DNS,$UserName,$Password);
    
} catch (\PDOException $e) {
    die("Cannot Connect With DataBase Because....   ".$e->getMessage());
} 



?>