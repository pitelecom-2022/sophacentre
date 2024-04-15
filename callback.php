<?php
require_once("db_config.php");
$query = "SELECT 
	phone_number,closecallid 
	FROM
	vicidial_closer_log 
	WHERE 
	status='DROP' and call_back=0";

$stmt = $link->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll();

$rows = sizeof($results);

for ($i=0; $i<$rows; $i++) {
	$phone_number = $results[$i]["phone_number"];
	$closecallid = $results[$i]["closecallid"];
	$handler = fopen($results[$i]["closecallid"]."_".$results[$i]["phone_number"] . ".call", "w");
	$text="Channel: SIP/" . $phone_number . "\nWaitTime:20\nRetryTime:10\nMaxRetries: 3\nSetVar: closecallid=".$closecallid."\nContext:trunkinbound\nExtension:5400\nArchive:yes";
	fwrite($handler, $text);
	fclose($handler);
	$text="";
	$query = "update vicidial_closer_log SET call_back=1 WHERE closecallid='$closecallid'";
	$stmt = $link->prepare($query);
	$stmt->execute();
 
}

system("mv *.call /var/spool/asterisk/outgoing");
