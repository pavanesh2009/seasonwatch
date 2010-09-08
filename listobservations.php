<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
	include_once("includes/dbc.php");
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>-->
<script>
  $(document).ready(function() {
    $("#obdate").datepicker({minDate: -120, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
  });
  </script>

  
<!--delete code from user-->
<?php 
if($_GET['id']!= "")
{ 
$usertreeid=($_GET['id']);  
$observationid=($_GET['observationId']);
//echo observationid;

$sql1 = "DELETE FROM user_tree_observations
               WHERE user_tree_id= '$usertreeid' AND observation_id='$observationid'";  
//echo "sql1";
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
echo  "<div class=\"notice\">Successfully Deleted</div>";
} 
?> 
 
 



<!--datepicker Script-->
<script type="text/javascript">
$(function() {
$("#obdate").datepicker({minDate: -120, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
});

$(function() {
$("#obdate1").datepicker({minDate: -120, maxDate: '0M +0D', dateFormat: 'yy-mm-dd'});
});

</script>


<script type = "text/javascript">
function confirmDelete(delUrl,observationid) {
  if (confirm("Are you sure you want to delete")) {
// alert(observationid);
 	url = 'listobservations.php?id='+delUrl+'&observationId='+observationid; 
 	//alert(url);
   window.document.location = url;
  }
else
{
url = 'listobservations.php';
 window.document.location = url;
}
}
</script>

<body>
<?php 
include ("header.php");
$speciesid="";
$speciesid=$_POST['species_control'];
$start_date=$_POST['obdate'];
$end_date=$_POST['obdate1'];
?>

<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>edit observations</a></li>
    </ul>
   </div>
<table>
<tbody>
<tr>
<td/>
</tr>
</tbody>
</table>
<div>
<hr/>
</div>

<table>
<form method="POST" action=<?php echo $_SERVER['PHP_SELF'];?> name="filterform"> 
<tr>

<td>
<h5>Filter by Tree Name, Date</h5>
<?php
if ($_SESSION[group_role]=='coord')
{
	$sql=mysql_query("SELECT DISTINCT(species_primary_common_name), species_master.species_id FROM species_master JOIN (trees, user_tree_table) ON trees.tree_id = user_tree_table.tree_id AND trees.species_id = species_master.species_id AND user_tree_table.user_id IN (select users.user_id from users where users.group_id='$_SESSION[group_id]')");
}
else
{
		$sql=mysql_query("SELECT DISTINCT(species_primary_common_name), species_master.species_id FROM species_master JOIN (trees, user_tree_table) ON trees.tree_id = user_tree_table.tree_id AND trees.species_id = species_master.species_id AND user_tree_table.user_id = '$_SESSION[user_id]'");
}	

$data1="<SELECT name=species_control>";
$data1 .= "<option value='All'>All</option>";
while($row=mysql_fetch_array($sql))
{
$data1 .= "<option value=".$row['species_id'];
if ($speciesid==$row['species_id']){$data1 .= " selected ";}
$data1 .= ">".$row['species_primary_common_name']."</option>";
}
$data1 .= "</select>";
echo $data1;
?>
<!--<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> -->

</td>
<td>
<div>
<br/><font color="#d95c15">Choose from pop-up or enter manually, eg 2010-05-24</font>
</div>
<div class="demo">
From-:<input id="obdate" name="obdate" type="text" value="<?php echo $_POST['obdate']; ?>"/>
</div>
<div style="display: none;" class="demo-description">
</div>
</td>
<td>
<div class="demo"><br/><br/>
To-:<input id="obdate1" name="obdate1" type="text" value="<?php echo $_POST['obdate1']; ?>"/>
</div>
<div style="display: none;" class="demo-description">
</div>
</td>
<td><br/><br/>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> 
</td>
</tr>
</form>
</table>





<table id="table1" class="tablesorter" cellspacing="0" cellpadding="3" style="width: 930px; margin-left: auto; margin-right: auto;">
<colgroup>
<!--<col style="width: 5px;"/>-->
<col style="width: 90px;"/>
<col style="width: 80px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 95px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 90px;"/>
<col style="width: 65px;"/>
<col style="width: 65px;"/>
</colgroup>
<thead>
<tr>
<!--<th class="header">No</th>-->
<th class="header">Primary Common Name</th>
<th class="header">Tree Nickname</th>
<th class="header">Observation Date</th>
<th class="header">Fresh Leaves</th>
<th class="header">Mature Leaves</th>
<th class="header">Flower Buds</th>
<th class="header">Open Flowers</th>
<th class="header">Unripe Fruit</th>
<th class="header">Ripe Fruit</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>

<?php 
//echo $speciesid;
$count=0;
print "<tr class='delboxtr'>";
//$user_tree_table_settings = mysql_query("SELECT tree_nickname, tree_id FROM  user_tree_table WHERE user_id='".$_SESSION[user_id]."'");
if ($_SESSION[group_role]=='coord')
{
	$sql_temp_results=mysql_query("SELECT user_id FROM  users WHERE group_id='".$_SESSION[group_id]."'");
	$sql_temp_results_row = mysql_fetch_array($sql_temp_results);
	//echo $sql_temp_results_row['user_id']. "xx";
	$user_id_array = " IN (" . $sql_temp_results_row['user_id'];
	while ($sql_temp_results_row = mysql_fetch_array($sql_temp_results)) 
	{
		$user_id_array .= "," . $sql_temp_results_row['user_id'];
	}
	$user_id_array .= ")";
	//echo "user_id_array: ". $user_id_array;
}
else
{
	$user_id_array=" = '".$_SESSION[user_id]."'";
}
if($speciesid=="" OR $speciesid=="All")
{
if($start_date=="" AND $end_date=="")
{
$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname, 
user_tree_observations.observation_id, 
user_tree_observations.date,
is_leaf_fresh, is_flower_open, is_fruit_ripe, 
is_leaf_mature, is_flower_bud, is_fruit_unripe,
species_master.species_primary_common_name 
FROM user_tree_observations 
INNER JOIN (users, user_tree_table, trees,species_master) 
ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
AND user_tree_table.user_id ". $user_id_array." 
AND users.user_id=user_tree_table.user_id 
AND user_tree_table.tree_id=trees.tree_id 
AND trees.species_id=species_master.species_id  
ORDER BY user_tree_table.tree_id");
}
elseif($start_date=="" AND $end_date!="")
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  WHERE  user_tree_observations.date <= '$end_date'");
}
elseif($start_date!="" AND $end_date=="")
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  WHERE  user_tree_observations.date >= '$start_date'");
}
else
{
$user_tree_table_settings=mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
  user_tree_observations.observation_id,user_tree_observations.date,
  is_leaf_fresh,
  is_flower_open, 
  is_fruit_ripe, 
  species_master.species_primary_common_name 
  FROM user_tree_observations 
  INNER JOIN 
  (users, user_tree_table,trees,species_master) 
  ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id
  AND user_tree_table.user_id ". $user_id_array." 
  AND users.user_id=user_tree_table.user_id 
  AND user_tree_table.tree_id=trees.tree_id 
  AND trees.species_id=species_master.species_id 
  WHERE  user_tree_observations.date BETWEEN '$start_date' AND '$end_date'");
}
}
else
{
if($start_date=="" AND $end_date=="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
       ORDER BY user_tree_table.tree_id");
}
elseif($start_date=="" AND $end_date!="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date <= '$end_date'
       ORDER BY user_tree_table.tree_id");
}
elseif($start_date!="" AND $end_date=="")
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date >= '$start_date'
       ORDER BY user_tree_table.tree_id");
}
else
{
	$user_tree_table_settings = mysql_query("SELECT user_tree_table.user_tree_id,tree_nickname,
   user_tree_observations.observation_id,user_tree_observations.date, 
	is_leaf_fresh, is_flower_open, is_fruit_ripe,
	is_leaf_mature, is_flower_bud, is_fruit_unripe,
	 species_master.species_primary_common_name 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id ". $user_id_array." 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND trees.species_id='$speciesid' 
	   WHERE  user_tree_observations.date BETWEEN '$start_date' AND '$end_date'
       ORDER BY user_tree_table.tree_id");
}
} 
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
print "<tr>";
$count++;  
//print "<td style='width:220px'>".$count."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['tree_nickname']."</td>";

$printdate = date("Y-m-d",strtotime($row_settings['date']));
//echo $printdate;


print "<td>".$printdate. "</td>";
//print "<td>".$row_settings[observation_id]. "</td>";
//print "<td>".$row_settings['user_tree_id']. "</td>";

$fresh_status = $row_settings['is_leaf_fresh'];
if($fresh_status == '1')
{
$fresh_status = 'Yes';
}
else
{
if($fresh_status == '0')
{
$fresh_status = 'No';
}
else
$fresh_status='Dont know';
}
echo "<td>" . $fresh_status . "</td>";
//print "<td>".$row_settings['is_leaf_fresh']. "</td>";

$mature_status = $row_settings['is_leaf_mature'];
if($mature_status == '1')
{
$mature_status = 'Yes';
}
else
{
if($mature_status == '0')
{
$mature_status = 'No';
}
else
$mature_status='Dont know';
}
echo "<td>" . $mature_status . "</td>";

$bud_status = $row_settings['is_flower_bud'];
if($bud_status == '1')
$bud_status = 'Yes';
else
if($bud_status == '0')
$bud_status = 'No';
else
if($bud_status == '2')
$bud_status = 'Dont know';
echo "<td>" . $bud_status . "</td>";

$open_status = $row_settings['is_flower_open'];
if($open_status == '1')
$open_status = 'Yes';
else
if($open_status == '0')
$open_status = 'No';
else
if($open_status == '2')
$open_status = 'Dont know';
echo "<td>" . $open_status . "</td>";
//print "<td>".$row_settings['is_flower_open']. "</td>";

$unripe_status = $row_settings['is_fruit_unripe'];
if($unripe_status == '1')
$unripe_status = 'Yes';
else
if($unripe_status == '0')
$unripe_status = 'No';
else
if($unripe_status== '2')
$unripe_status = 'Dont know';

echo "<td>" . $unripe_status . "</td>";

$ripe_status = $row_settings['is_fruit_ripe'];
if($ripe_status == '1')
$ripe_status = 'Yes';
else
if($ripe_status == '0')
$ripe_status = 'No';
else
if($ripe_status== '2')
$ripe_status = 'Dont know';

echo "<td>" . $ripe_status . "</td>";


//print "<td>".$row_settings['is_fruit_ripe']. "</td>";


$editobservationLink = "<a class=thickbox rel=gallery-plants href=\"editobservations.php?usertreeid=".$row_settings['user_tree_id']."&observationid=".$row_settings['observation_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";

print "<td>$editobservationLink</td>";

$var=$row_settings['user_tree_id'];
$var1=$row_settings['observation_id'];
$deleteobservationLink = "<a  href='listobservations.php' onclick=confirmDelete('$var','$var1');>Delete</a>";
//$deletetreelink="<a class=thickbox href=\"deleteobservation.php?usertreeid=".$row_settings['user_tree_id']."&observationid=".$row_settings['observation_id']."&TB_iframe=true&height=500&width=700\">Delete</a>";
print "<td>$deleteobservationLink</td>";
print "</tr>";
}  
echo "</tbody></table>";
?>



<html> 
<p align="center"> 
<input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">
</p>
</div>
</div>
<div class="container bottom">
<?php mysql_close($link);?>
</div>
<?php 
   include("footer.php");
?>
</body>
</html>



