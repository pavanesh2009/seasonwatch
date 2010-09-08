<?php
session_start();
include("includes/dbc.php");


$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "SELECT tree_location_id, location_name, city,state ";
$sql.= "FROM location_master ";
$sql.= "INNER JOIN seswatch_states ";
$sql.= "ON location_master.state_id = seswatch_states.state_id ";
if(is_numeric($_GET['state'])) {
$sql.= " WHERE seswatch_states.state_id = " . $_GET['state'];
}
$sql.=" ORDER BY seswatch_states.state";

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
    $location_id = $row['tree_location_id'];
    $key1 = $row['location_name'];
    $key1.= ', '.$row['city'];
    //$key1.= ', '.$row['district'];
    $key1.= ', '.$row['state'];
        
    $items[$key1] = $row['tree_location_id']."|".$row['location_name']."|".$row['city']."|".$row['state'];
}
foreach ($items as $key=>$value) {
	if (stripos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	} else {
           $loci[] = $key;
}     }



?>
