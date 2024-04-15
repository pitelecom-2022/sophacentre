<?php

$host = "localhost";
$user = "cron";
$passwd = "8ytbpce0upxy";
$dbname = "asterisk";

try {
    $link = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
}catch(PDOException $e)
{
  echo $e->getMessage();                         
}


?>
