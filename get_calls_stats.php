
<?php
	require_once("db_config.php");
	include("./functions.php");

	if (isset($_GET["custom"])) {
        	$from = $_GET["from"];
		$to = $_GET["to"];
	
	$query_acl = "SELECT AVG(length_in_sec - queue_seconds) AS acl FROM vicidial_closer_log WHERE call_date BETWEEN '$from' AND '$to' AND status!='DROP' ";
	$query_sla = "SELECT count(*) AS sla FROM vicidial_closer_log WHERE call_date BETWEEN '$from' AND '$to' AND status!='DROP' AND queue_seconds<20";
	$query_drop_calls = "SELECT count(*) AS drop_calls FROM vicidial_closer_log WHERE status='DROP' AND call_date BETWEEN '$from' AND '$to' ";
	$query_aht = "SELECT AVG(queue_seconds) AS aht FROM vicidial_closer_log WHERE call_date BETWEEN '$from' AND '$to' AND status!='DROP' ";
	$query_total_calls = "SELECT count(*) AS total_calls FROM vicidial_closer_log WHERE call_date BETWEEN '$from' AND '$to' ";
	}

	else {

		$target = ($_GET["target"]) ? $_GET["target"]:'last_month';
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
		}
	
	$query_acl = "SELECT AVG(length_in_sec - queue_seconds) AS acl FROM vicidial_closer_log WHERE date(call_date) BETWEEN '$from' AND '$to' AND status!='DROP' ";
	$query_sla = "SELECT count(*) AS sla FROM vicidial_closer_log WHERE date(call_date) BETWEEN '$from' AND '$to' AND status!='DROP' AND queue_seconds<20";
	$query_drop_calls = "SELECT count(*) AS drop_calls FROM vicidial_closer_log WHERE status='DROP' AND date(call_date) BETWEEN '$from' AND '$to' ";
	$query_aht = "SELECT AVG(queue_seconds) AS aht FROM vicidial_closer_log WHERE date(call_date) BETWEEN '$from' AND '$to' AND status!='DROP' ";
	$query_total_calls = "SELECT count(*) AS total_calls FROM vicidial_closer_log WHERE date(call_date) BETWEEN '$from' AND '$to' ";
	}

	$acl = query_mysql($query_acl,$link)[0]["acl"];	
	$sla = query_mysql($query_sla,$link)[0]["sla"];	
	$drop_calls = query_mysql($query_drop_calls,$link)[0]["drop_calls"];
	$aht = query_mysql($query_aht,$link)[0]["aht"];
	$total_calls = query_mysql($query_total_calls,$link)[0]["total_calls"];

	$output["acl"] = $acl;
	$output["total_calls"] = $total_calls;
	$output["drop_calls"] = $drop_calls;
	$output["aht"] = $aht;
	if($total_calls>0) {
		$output["drop_pc"] = $drop_calls/$total_calls;
		$output["sla"] = 100*number_format($sla/$total_calls,2);
	}
	else $output["drop_pc"] = 0;
	
	echo json_encode($output);
?>
