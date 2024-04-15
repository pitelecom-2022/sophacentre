<?php

session_start();
require_once("./db_config.php");
include ("./functions.php");
include ("./header.php");

?>

<div class="w3-padding-32 w3-center">
<h1>Missed Calls</h1>
</div>

<div class="w3-content">

<table class="w3-table-all">

<tr>
<th>Call Date</th><th>Phone Number</th><th>Waiting before Abondon(sec)</th>
</tr>

<?php

$query = "SELECT call_date, phone_number, length_in_sec FROM vicidial_closer_log WHERE status='DROP' ORDER BY call_date DESC";
$stmt = $link->prepare($query);
$stmt->execute();

$missed_calls = $stmt->fetchAll();

$i=0;

while($i<sizeof($missed_calls)) {
	$missed_call = $missed_calls[$i];
	$call_date = $missed_call['call_date'];
	$phone_number = $missed_call['phone_number'];
	$duration = $missed_call['length_in_sec'];
	echo " 
		<tr>
		<td>$call_date</td>
		<td>$phone_number</td>
		<td>$duration</td>
		</tr>
	";
	$i++;
}
?>

</table>
</div>
