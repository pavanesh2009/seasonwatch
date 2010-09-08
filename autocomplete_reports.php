<?php
include("includes/dbc.php");

 // again if we are on php4
if (!function_exists("stripos")) {
	function stripos($str,$needle,$offset=0)
  	{
    	return strpos(strtolower($str),strtolower($needle),$offset);
  	}
}

$q = strtolower($_GET["q"]);
if (!$q) return;


$sql = "SELECT species_id,species_primary_common_name,species_scientific_name FROM species_master";
if (!isset($_GET['all'])) {
	$sql .= " order by species_id";
}
//for php4 $res = mysql_query($sql,$connect);
$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res)) {
	$key = $row['species_primary_common_name'];
	if (!empty($row['species_search_names'])) {
		$row['species_search_names'] = str_replace(',',' or ',$row['species_search_names']);
		$key .= ' or '.$row['species_search_names'];
	}

	if (!empty($row['species_scientific_name'])) {
		$key .= ' ('.$row['species_scientific_name'].')';
	}

	//$items[trim($key)] = $row['show_hint'];
        $items[trim($key)] = $row['species_id'];
}

foreach ($items as $key=>$value) {
	if (stripos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}
?>
