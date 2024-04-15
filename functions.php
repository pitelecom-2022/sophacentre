<?php

function return_class($status) {
	switch($status){
		case "CLOSER":
			$class= "w3-blue";
			break;
		case "PAUSED":
			$class = "w3-yellow";
			break;
		case "INCALL":
			$class = "w3-red";
			break;
		default:
			$class = "w3-green";
	}
	return $class;

}

function format_phone_number ($pn) {
	}

function is_prime($n) {
	$p=2;
	while($p<=$n/2) {
		if ($n%$p==0) {
			return false;
		}
		$p++;
	}
	return true;
}



function query_mysql($query, $link) {
	$stmt = $link->prepare($query);
	$stmt->execute();
	$results = $stmt->fetchAll();
	return $results;
}


function print_error($msg) {
	echo "<div class=\"w3-content w3-center w3-container w3-pale-red w3-border-red w3-leftbar\">";
	echo "<p>".$msg."</p>";
	echo "</div>";
}

function agent_full_name($id, $link) {
        $query = "
                SELECT full_name
                FROM vicidial_users
                WHERE user='$id'
         ";
         $stmt = $link -> prepare($query);
         $stmt -> execute();
         $result = $stmt->fetchAll();
         return $result[0]["full_name"];
}

function phone_number($x){
        $pos = strpos($x, '_')+1;
        return substr($x, $pos);
}

function get_date_difference($timein, $timeout) {

$diffs = [
    'years' => 'y',
    'months' => 'm',
    'days' => 'd',
    'hours' => 'h',
    'minutes' => 'i',
    'seconds' => 's'
];

$interval = $timeout->diff($timein);
$diffArr = [];
foreach ($diffs as $k => $v) {
    $d = $interval->format('%' . $v);
    $diffArr[] = $d;
}
return $diffArr;
}

?>

