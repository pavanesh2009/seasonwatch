<?
$where_clause = "";
$sql = "";

$sql = "Select species_master.species_id, species_master.species_search_names,
species_master.species_primary_common_name, 
location_master.longitude, location_master.latitude,
location_master.tree_location_id,
location_master.location_name,
location_master.city,seswatch_states.state,
users.full_name,users.user_name,user_tree_table.user_id, 
user_tree_table.last_observation_date,
trees.tree_id,
seswatch_states.state";

$sql .= " FROM location_master INNER JOIN trees ON location_master.tree_location_id = trees.tree_location_id";
$sql .= " INNER JOIN species_master ON species_master.species_id=trees.species_id ";
$sql .= " INNER JOIN user_tree_table ON user_tree_table.tree_id=trees.tree_id ";
$sql .= " INNER JOIN users ON users.user_id=user_tree_table.user_id ";
$sql .= " INNER JOIN seswatch_states ON seswatch_states.state_id=location_master.state_id ";
 
           
if( ( $_GET['species'] != "All" ) || $_GET['species'] != "" ) {
   $species = $_GET['species'];
} else {
   $species = "All";
}
if( $species && is_numeric($species) ) {                                  
 $tempsql = "select species_search_names from species_master where species_id='$species'";
   $result = mysql_query($tempsql);
   if($result) {
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $strSpecies = $row{'species_search_names'};
     }
   }
}

if($species){
   if($species != 'All' )
   if ($where_clause == ""){
     $where_clause = " WHERE species_master.species_id = ". $species;
   } else {
     $where_clause .= " AND species_master.species_id=".$species;
   }
}

             
if( ($_GET['location'] != 'All') || ($_GET['location'] != '') || ($_GET['location'] != $locationHintText )) {
   $location = $_GET['location'];
} else {	          
   $location = 'All';
}

if( $location && is_numeric($location) ) {   
   //$where_clause = " WHERE l1.location_id=". $location;
   $tempsql = "SELECT location_master.tree_location_id,location_master.latitude, location_master.location_name, location_master.city, seswatch_states.state FROM location_master INNER JOIN (seswatch_states) ON location_master.state_id=seswatch_states.state_id WHERE tree_location_id='$location'";
   $result = mysql_query($tempsql);
   if($result) {
   while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
   $strLocation = $row{'location_name'};
   
   if( $row['city'] != "" ) { 
    $strLocation .= ", ". $row['city'];
   }
     
  }						   
 }
}
                               
if($location){
   if($location != 'All' )
   if ($where_clause == ""){
     $where_clause = " WHERE location_master.tree_location_id = ".$location;
   } else {
     $where_clause .= " AND location_master.tree_location_id=".$location;
   } 
}

if( $_GET['season'] != '') {
  if ( strtolower($_GET['season']) != 'all' ) {
     $season = $_GET['season'];
  } 
}


if($season != '' && strtolower($season) !='all' ) {         
   $seasonArr = explode('-',$season);
   $seasonStart = $seasonArr[0];
   $seasonEnd = $seasonArr[1];
		
 /*		
   if ($where_clause == "") {
     $where_clause = " WHERE user_tree_observations.date BETWEEN '$seasonStart-10-01' AND '$seasonEnd-06-30' AND user_tree_observations.date <> '1999-11-30' AND user_tree_observations.date <> '0000-00-00' ";
   } else {
     $where_clause .= " AND user_tree_observations.date BETWEEN '$seasonStart-10-01' AND '$seasonEnd-06-30' AND user_tree_observations.date <> '1999-11-30' AND user_tree_observations.date <> '0000-00-00' ";
   }
*/
		
}
	
if( ($_GET['user'] != 'All') || ($_GET['user'] != '')) {
   $user = $_GET['user'];
} else {
   $user = 'All';
}

if ($user){
   if($user != 'All')
     if ($where_clause == "") {
       $where_clause = " WHERE users.user_id = ".$_GET['user'];
     } else {
        $where_clause .= " AND users.user_id = ".$_GET['user'];
     }

    $tempsql = "Select full_name, user_name from users where user_id=".$_GET['user'];
   $result = mysql_query($tempsql);
   $strUserName = "";
   if($result){
     while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
       $strUserName = $row{'full_name'};
   }
}

if( is_numeric($_GET['state']) )  {
   $state = $_GET['state'];
} else {
   $state = 'All';
}

if( is_numeric($state)) {
   if($where_clause == '') {
   $where_clause = " WHERE seswatch_states.state_id = ".$_GET['state'];
   } else {
         $where_clause .= " AND seswatch_states.state_id = ".$_GET['state'];
   }
}

//Important-Don't delete By Pavanesh Aug27 2010
if ($_SESSION['dev_entries'] == 1) {
	// Show all entries : including the ones from developer
} else {
       $where_clause .= " AND users.user_name != 'Developer'";
}

	$sql .= $where_clause;
?>
