<?php

session_start();

require_once("./db_config.php");
require_once("./header.php");
include("./functions.php");

/*
 * 
$query_total_reclamations = "SELECT count(*) AS total FROM custom_999 WHERE reclamation='Oui' ";
$query_reclamations_en_cours = "SELECT count(*) AS en_cours FROM custom_999 WHERE reclamation='Oui' AND etat_reclamation='En cours de traitement'";
$query_reclamations_traitees = "SELECT count(*) AS traitees FROM custom_999 WHERE reclamation='Oui' AND etat_reclamation='Traitée'";
$query_reclamations_non_traitees = "SELECT count(*) AS non_traitees FROM custom_999 WHERE reclamation='Oui' AND  etat_reclamation='Non Traitée'";
$query_relances = " SELECT count(*) AS total FROM custom_999 WHERE frequence_appel>1 AND etat_reclamation='En cours de traitement' ";

$reclamations_total = query_mysql($query_total_reclamations, $link)[0]["total"];
$reclamations_en_cours = query_mysql($query_reclamations_en_cours, $link)[0]["en_cours"];
$reclamations_traitees = query_mysql($query_reclamations_traitees, $link)[0]["traitees"];
$reclamations_non_traitees = query_mysql($query_reclamations_non_traitees, $link)[0]["non_traitees"];
$relances = query_mysql($query_relances, $link)[0]['total'];
 */
?>

<div class="w3-center">
<!--
<h2>Reclamation Stats <br> <i onclick = "location.reload()" style="cursor:pointer" class="w3-small fa fa-refresh"></i></h2>
</div>
<div class="kpis w3-padding-32">
	<div class="kpi">
		<div class="w3-indigo kpi_designationi">Total Réclamations</div>
		<div class="kpi_value" id="total_reclamation"><?php echo $reclamations_total; ?></div>
		<div class="link w3-small">
			<a href="./reclamations.php?">Détails &rarr;</a>
		</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo kpi_designationi">Réclamations en cours</div>
		<div class="kpi_value"><?php echo $reclamations_en_cours; ?></div>
		<div class="kpi_value"><?php echo $relances; ?></div>
		<div class="link w3-small">
			<a href="./reclamations.php?statut_reclamation=En cours de traitement">Détails &rarr;</a>
		</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo kpi_designationi">Réclamations traitées</div>
		<div class="kpi_value"><?php echo $reclamations_traitees; ?></div>
		<div class="link w3-small">
			<a href="./reclamations.php?statut_reclamation=Traitée">Détails &rarr;</a>
		</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo kpi_designationi">Réclamations non traitées</div>
		<div class="kpi_value"><?php echo $reclamations_non_traitees; ?></div>
		<div class="link w3-small">
			<a href="./reclamations.php?statut_reclamation=Non Traitée">Détails &rarr;</a>
		</div>
	</div>
</div>

<div class="w3-padding-16"></div>
!-->

<div class="w3-center w3-section">
	<h2>Dashboard</h2>
	<h4><i class="fa fa-dashboard w3-text-indigo"></i>
</div>

<div class="w3-center w3-section" style="width:20%; margin:auto">
<select class="w3-select w3-border w3-round" name="calls_stats_time_range" id="calls_stats_time_range">
	<option selected="true" value="today">Aujourd'hui</option>
	<option value="yesterday">Hier</option>
	<option value="this_week">Cette semaine</option>
	<option value="this_month">Ce mois</option>
	<option value="last_week">La semaine dernière</option>
	<option value="last_month">Le mois dernier</option>
	<option value="custom">Choisir un intervalle</option>
</select>
<div id="custom_range" class="w3-section w3-small w3-center w3-container">
<button class="w3-button w3-light-grey w3-right" onclick="this.parentElement.style.display='none'">&times;</button>
<table>
<tr>
<td>From</td><td><input type="date" id="custom_from_date" value="<?php echo date('Y-m-d'); ?>"><td><input type="time" id="custom_from_time"></td>
</tr>
<tr>
<td>To</td><td><input type="date" id="custom_to_date" value="<?php echo date('Y-m-d'); ?>"></td><td><input type="time" id="custom_to_time"></td>
</tr>
<tr>
<td colspan=2><button id="go" class="w3-button w3-indigo">Go</button></td>
</tr>
</table>
</div>
</div>
<h3>Calls</h3>
<div class="kpis w3-padding-32">
<div class="kpi">
		<div class="w3-indigo">Appels reçus</div>
		<div class="kpi_value" id="total_calls"></div>
		<div class="" id="">
		<a id="calls_search" href="./calls.php?from=<?php echo date("Y-m-d");?>&to=<?php echo date("Y-m-d"); ?>" class="w3-small">Détails <span class="w3-circle w3-border">&rarr;</span></a>
		</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo">Appels abandonnés</div>
		<div class="kpi_value" id="drop_calls"></div>
		<div class="" id="">
		<a id="drop_calls_search" href="./calls.php?from=<?php echo date("Y-m-d"); ?>&to=<?php echo date("Y-m-d"); ?>&status=DROP" class="w3-small">Détails <span class="w3-circle w3-round">&rarr;</span></a>
		</div>
	</div>
</div>
<h3>KPIs</h3>
<div class="kpis">
	<div class="kpi">
		<div class="w3-indigo">Attente moyenne (sec)</div>
		<div class="kpi_value" id="aht">-</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo">DMT <sup>(*)</sup></div>
		<div class="kpi_value" id="acl">-</div>
	</div>
	<div class="kpi">
		<div class="w3-indigo">SLA <sup>(**)</sub></div>
		<div class="kpi_value" id="sla">-</div>
	</div>
</div>
</div>

<div class="w3-content">
<span class="w3-small">(*) DMT = Durée moyenne d'appels traités.</span> <br>
<span class="w3-small">(**) SLA = Service Level Agreement = % des appels reçus et traités en moins de 20 secondes.</span>
</div>

</div>
</div>

<script>

$().ready($("#custom_range").hide());

function update(ajax_object) {
	$.get("./get_calls_stats.php", ajax_object, function(output, status) {
		let data=JSON.parse(output);
		$("#total_calls").html(data.total_calls);
		$("#drop_calls").html(data.drop_calls + "<span class='w3-small w3-margin-left'>(" + 100*parseFloat(data.drop_pc).toFixed(2) + "%)</span>");
		$("#aht").html(Math.max(0,parseFloat(data.aht).toFixed(2)));
		if (data.sla) {
			$("#sla").html(data.sla + "%");
		}
		else {
			$("#sla").html("N/A");
		}
		$("#acl").html(Math.max(0,parseFloat(data.acl).toFixed(2)));
	})
}

update({target:"today"})

$("#calls_stats_time_range").change(function() {
	let target = $(this).val()
	if(target=="custom") {
		$("#custom_range").show();
		$("#go").click(function() {		
			let from_date=$("#custom_from_date").val(),
				from_time=$("#custom_from_time").val(),
				from=from_date+" "+from_time,
				to_date=$("#custom_to_date").val(),
				to_time=$("#custom_to_time").val(),
				to=to_date+" "+to_time
			$("#calls_search").attr('href',"./calls.php?from="+from+"&to="+to);
			$("#drop_calls_search").attr('href',"./calls.php?from="+from+"&to="+to+"&status=DROP");
			console.log($("#calls_search").attr("href"))
			ajax_object={custom:true,from,to}
			update(ajax_object)	
		})
	}
	else {
		update({target:target});
		$("#calls_search").attr("href","./calls.php?target="+target);
		$("#drop_calls_search").attr("href","./calls.php?target="+target+"&status=DROP");
		}
})	

</script>

</body>
