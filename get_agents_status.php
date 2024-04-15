<?php
require_once("db_config.php");
	include("./functions.php");
	$query = "select * from vicidial_live_agents";
	$agents = query_mysql($query, $link);
	if (sizeof($agents)>0) {
	$agents_status = "
		<table class=\"w3-table-all\">
		<thead>
			<tr>
				<th>User ID</th>
				<th>Extension</th>
				<th>Statut</th>
				<th>Calls today</th>
				<th>Monitor</th>
			</tr>
		</thead>
	";
	for ($i=0; $i<sizeof($agents); $i++) {
		$color = return_class($agents[$i]["status"]);
		$agents_status .= "<tr class=\"w3-small\">";
		$agents_status .= "<td>" . $agents[$i]["user"] . "</td>";
		$agents_status .= "<td>" . $agents[$i]["extension"] . "</td>";
		$agents_status .= "<td> <span class=\"w3-tag $color\">" . $agents[$i]["status"] . "</span></td>";
		$agents_status .= "<td>" . $agents[$i]["calls_today"] . "</td>";
		$agents_status .= "<td><button class=\"w3-button w3-blue\">Listen</button></td>";
		$agents_status .= "</tr>";
	}
	}
	else {
		$agents_status = "Aucun agent n'est connecté en ce moment!";
	}
	$output["agents_status"]= $agents_status;
	echo json_encode($output);
?>

