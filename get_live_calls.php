<?php
require_once("db_config.php");
	include("./functions.php");
	$query = "select phone_number, last_update_time - call_time as wait_time, status from vicidial_auto_calls";
	$live_calls = query_mysql($query, $link);
	if (sizeof($live_calls)>0) {
	$calls = "
		<table class=\"w3-table-all\">
		<thead>
			<tr>
				<th>Phone Number</th>
				<th>Dial Time</th>
				<th>Statut</th>
			</tr>
		</thead>
	";
	for ($i=0; $i<sizeof($live_calls); $i++) {
		$calls .= "<tr class=\"w3-small\">";
		$calls .= "<td>" . $live_calls[$i]["phone_number"] . "</td>";
		$calls .= "<td>" . $live_calls[$i]["wait_time"] . "</td>";
		$calls .= "<td>" . $live_calls[$i]["status"] . "</td>";
		$calls .= "</tr>";
	}
	}
	else {
		$live_calls = "Y'a aucun appel en attente!";
	}
	$output["live_calls"]= $calls;
	echo json_encode($output);
?>

