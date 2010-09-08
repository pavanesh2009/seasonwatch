<? 
    include("includes/dbc.php"); 
    include("functions.php"); 

    $where_clause = "";
    include("query_reports.php");

$loc = $_GET['location'];
$store="select latitude,longitude from location_master Where tree_location_id='$loc'";
$getloc=mysql_query($store);

while($final_loc = mysql_fetch_array($getloc)) {

$lat_new=$final_loc['latitude'];
$lng_new=$final_loc['longitude'];
}
//echo $lat_new;
//echo $lng_new;


//AND location_master.tree_location_id='$treelocid'
    $where_clause3 = "AND location_master.latitude ='$lat_new' AND longitude='$lng_new' order by location_master.latitude DESC";

    $sql .=  $where_clause3;
    $result = mysql_query($sql);   
    $total_count = mysql_num_rows($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  </head> 
  <body> 
<?php 
        $i=1;
        $final_report = '';
        while($line = mysql_fetch_assoc($result)) {
                  

                      $loc_name ="<h4>" . addslashes($line['location_name']) . ", " . addslashes($line['city']) . ", " . addslashes($line['state']) . "</h4><br>";
                      $user_reports  ="<dt><small>Displaying " . $i ."/" . $total_count . "<br>" . addslashes($line['species_primary_common_name']) . ",   " .  addslashes($line['full_name']);
                      //$user_reports .=",   " . addslashes($line['sighting_date']);
                      $user_reports .= "</small></dt>"; 
                      $final_report .= stripslashes($user_reports);
                      $total_reports['location'] =  $loc_name;
                      $i++;    
        } 
?>

<div class="tickerContainer" style='padding:10px;height:120px'>
<div id='loc_name'><? echo  $total_reports['location']; ?></div>
<dl class='ticker'><? echo $final_report; ?></dl>
<div class="nav" style='text-align:right'><a id="prev2" href="#x">Prev</a> <a id="next2" href="#x">Next</a></div>
</div>
</body> 
</html>
