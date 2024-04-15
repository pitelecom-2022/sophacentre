
<?php
session_start();
require_once("db_config.php");
require_once("header.php");
include "functions.php";
?>

<div class="w3-padding-32 w3-panel w3-center">
	<h2>Live Monitoring</h2>
	<h4><i class="fa fa-clock-o w3-text-indigo"></i>
</div>

<div class="w3-center">
<h4>Live Calls</h4>
<div id="live_calls" class="w3-center w3-content">
</div>

<h4>Agents status</h4>
<div id="agents_status" class="w3-center w3-content">
</div>

</div>

<script>

function get_agents_status() {
	$.get("get_agents_status.php", function(output, status){
		let data = JSON.parse(output);
		$("#agents_status").html(data.agents_status);
	})
}

function get_live_calls()  {
	$.get("get_live_calls.php", function(output, status){
		let data= JSON.parse(output);
		$("#live_calls").html(data.live_calls);
	})
}

setInterval(function() {get_agents_status(); get_live_calls()},1000);

</script>
