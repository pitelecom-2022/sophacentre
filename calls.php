<?php

session_start();
require_once("db_config.php");
require_once("header.php");

$today = date("Y-m-d");
$phone_number = $_GET['phone_number'];
$user = $_GET["agent_id"];
$queue = $_GET["queue"];
$target = $_GET["target"];
if ($target) {
                switch ($target) {
                        case 'today':
                                $from = date("Y-m-d");
                                $to = date("Y-m-d");
                        break;
                        case 'yesterday':
                                $from = date("Y-m-d", strtotime("yesterday"));
                                $to = date("Y-m-d", strtotime("yesterday"));
                        break;
                        case 'last_week':
                                $from = date("Y-m-d", strtotime("last week monday"));
                                $to = date("Y-m-d", strtotime("last week sunday"));
                        break;
                        case 'last_month':
                                $from = date("Y-m-d", strtotime("first day of previous month"));
                                $to  = date("Y-m-d", strtotime("last day of previous month"));
                        break;
                        case 'this_week':
                                $from = date("Y-m-d", strtotime("this week monday"));
                                $to = date("Y-m-d");
                        break;
                        case 'this_month':
                                $from = date("Y-m-d", strtotime("first day of this month"));
                                $to = date("Y-m-d");
                        break;
		}}
else {
	$from = $_GET["from"];
	$to = $_GET["to"];
}

$status = $_GET["status"];

$exp = $user?" user='$user'":1;
if ($status=="DROP") {
	$exp .= " and status='DROP'";
}
elseif ($status=="processed") {
	$exp .= " and status!='DROP'";
}
else {
	$exp .= "";
}

$exp .= $phone_number?" and phone_number='$phone_number'":"";
$exp .= $queue?" and campaign_id='$queue'":"";
$exp .= $from?" and date(call_date)>='$from'":'';
$exp .= $to?" and date(call_date)<='$to'":'';

$query = "SELECT * from vicidial_closer_log WHERE $exp order by call_date desc";

$stmt = $link->prepare($query);
$stmt->execute();
$calls = $stmt->fetchAll();

$rows = sizeof($calls);

$export_reclamations = "<i class=\"fa fa-download w3-text-indigo\"></i>";

echo <<<TXT

<div class="w3-padding-32 w3-center">
	<h2>Journal d'appels</h2>
	<p>$export_reclamations</p>
</div>

<div class="w3-light-grey w3-padding-64 w3-container">
	<div class="w3-center">
		<h4>Options de filtrage</h4>
	</div>
	<form action="" method="GET">
	<div class="filter">
	  <input type="text" class="w3-input w3-border w3-round" placeholder="Numéro de téléphone" name="phone_number">
	  <select class="w3-select w3-border" name="status">
		<option selected disabled>Statut</option>
		<option value="processed">Traité</option>
		<option value="DROP">Abondonné</option>
	 </select>
	<input type="text" class="w3-input w3-border w3-round" placeholder="Agent ID" name=agent_id">
	<select class="w3-select w3-border" name="queue">
		<option selected disabled>File d'attente</option>
		<option value="700">700 (prise de commande rabat)</option>
		<option value="701">701 (prise de commande casa))</option>
	</select>
	</div>
	<div class="filter search-reclamations-time-range w3-section">
		<div>From: <input type="date" class="w3-input" name="from"></div>
		<div>To: <input type="date" class="w3-input" name="to"></div>
	</div>
	<div class="w3-container w3-center w3-section">
		<input type="submit" name="filter_submit" class="w3-button w3-round w3-indigo" value="Search">
	</div>
	</form>
</div>

<div class="w3-content">
<table class="w3-table w3-bordered" id="calls_table">
	<thead>
		<tr>
			<th>Date d'appel</th>
			<th>Numéro de téléphone</th>
			<th>Agent ID</th>
			<th>Status</th>
			<th>File d'attente</th>
			<th>Durée de communication</th>
			<th>Durée d'attente</th>
			<th>Enregistrement</th>
		</tr>
	</thead>

TXT;

for ($i=0; $i<$rows; $i++) {
	$call = $calls[$i];
	$lead  = $call["lead_id"];
	$call_duration = number_format($call["length_in_sec"]-$call["queue_seconds"],0);
	echo "<tr class=\"w3-small\">";
	echo "<td>" . $call["call_date"] . "</td>";
	echo "<td>" . $call["phone_number"] . "</td>";
	if ($call["status"] != "DROP") {
		echo "<td>". $call["user"] . "</td>";
	}
	else {
		echo "<td> - </td>";
	}
	echo "<td>" . $call["status"] . "</td>";
	echo "<td>" . $call["campaign_id"] . "</td>";
	echo "<td>" . $call_duration .  "</td>";

	echo "<td>" . $call["queue_seconds"] .  "</td>";

	$query_recording = "SELECT filename,location FROM recording_log WHERE lead_id='$lead'";
	$stmt = $link->prepare($query_recording);
	$stmt->execute();
	$recording = $stmt->fetchAll();
	if ($call["status"]!="DROP") {
		echo "<td><a href=\"" . $recording[0]["location"] . "\"><i class=\"fa w3-text-indigo fa-headphones\"></a></td>";
	}
	else {
		echo "<td>-</td>";
	}
	echo "</tr>";
}

echo "</tbody></table>";
?>

<script>
	$(document).ready($("#calls_table").dataTable());
</script>
</body>


