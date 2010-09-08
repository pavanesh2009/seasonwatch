<?php
include("includes/dbc.php");
	//$ip = $_SERVER['REMOTE_ADDR'];
	
//echo $ip;
	// List points from database
	if ($_GET['action'] == 'listpoints') {
		$query = "SELECT location_name,latitude,longitude, species_primary_common_name, full_name FROM location_master as lm 
		INNER JOIN (trees as t,species_master as sm, user_tree_table as ut,users as u) 
		ON lm.tree_location_id=t.tree_location_id AND t.species_id=sm.species_id AND ut.tree_id=t.tree_id AND ut.user_id=u.user_id ORDER BY location_name";
		$result = mysql_query($query);
		$points = array();
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			array_push($points, array('name' => $row['location_name'], 'lat' => $row['latitude'], 'lng' => $row['longitude'], 'full_name' => $row['full_name'], 'species_name' => $row['species_primary_common_name']));
		}
		echo json_encode(array("Locations" => $points));
		exit;
	}
	
	//	function map_query($query) {
		// Connect
		//mysql_connect('localhost', 'root', 'root')
//		    OR die(fail('Could not connect to database.'));
		
		//mysql_select_db('ncbs_test');
		//return mysql_query($query);
	//}
	
	function fail($message) {
		die(json_encode(array('status' => 'fail', 'message' => $message)));
	}
	
	function success($data) {
		die(json_encode(array('status' => 'success', 'data' => $data)));
	}
	
/* // Save a point from our form
	if ($_POST['action'] == 'savepoint') {
		$name = $_POST['name'];
		if(preg_match('/[^\w\s]/i', $name)) {
			fail('Invalid name provided.');
		}
		if(empty($name)) {
			fail('Please enter a name.');
		}
	
		
		// Query
		$query = "INSERT INTO location_master SET location_name='$_POST[name]', latitude='$_POST[lat]', longitude='$_POST[lng]'";
		$result = map_query($query);
		
		if ($result) {
			success(array('lat' => $_POST['lat'], 'lng' => $_POST['lng'], 'name' => $name));
		} else {
			fail('Failed to add point.');
		}
		exit;
	} */	
?>
