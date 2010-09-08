<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
   //include_once("functions.php");
?>


<script type="text/javascript">
function validatelist(thisform)
{
if(document.filterform.tree_control.value == 0)
{
alert("Please choose a valid tree name!!");
return false;
}
return true;
}
</script>
</head>


<body>
<?php
include ("header.php");
?> 
<div class="container first_image" style=" background-color:#fffff9; background-image: url('images/gradientbg.png'); background-repeat: repeat-x; background-position: bottom left; width:950px; padding-bottom:5px;"><!-- style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;"> -->
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>my home</a></li>
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
</div>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td colspan="2">
<hr/>
</td>
</tr>
<tr>
<td class="cms" style="border-right: 1px solid rgb(217, 92, 21); width: 60%;">
<h3 align="middle">my trees</h3>
<p>
<span style="">
<table id="table1" class="tablesorter"  cellspacing="0"  style="width: 500px; margin-left: auto; margin-right: auto;">
<colgroup>
<col style="width: 82px;"/>
<col style="width: 82px;"/>
<col style="width: 87px;"/>
<col style="width: 82px;"/>
<col style="width: 85px;"/>
</colgroup>
<thead>
<tr>
<th></th>
<th>Primary Name</th>
<th>Nickname</th>
<th>Last Observation</th>
<th>Observations</th>
</tr>
</thead>
<tbody>

<?php 
$count=0;
//print "<tr class='delboxtr'>";
$user_tree_table_settings = mysql_query("SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id, species_master.species_id, user_tree_table.last_observation_date FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[user_id]') ON species_master.species_id = trees.species_id ORDER BY user_tree_table.last_observation_date ASC LIMIT 0 , 5");
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
print "<tr>";
$count++;

$result3 = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$row_settings[species_id]'");
$image_names = mysql_fetch_array($result3);
$species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
print "<td><a href='$species_pic1?TB_iframe=true' title='click for larger image' alt='click to view larger image' class='thickbox'><img src='".return_thumbnail($species_pic1)."'  width='70px'></a></td>";  

print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['tree_nickname']."</td>";
print "<td bgcolor>".$row_settings['last_observation_date']."</td>";
$treeLinkBegin = "<a class=thickbox rel=gallery-plants href=\"userobservations.php?usertreeid=".$row_settings['user_tree_id']."&TB_iframe=true&height=500&width=700\">Add</a>";

print "<td style='text-align: center;'>$treeLinkBegin</td>";

print "</tr>";
}  

echo "</tbody></table>";
echo "<table id='table1'  cellspacing='0' cellpadding='3' style='width: 330px; margin-left: auto; margin-right: auto;'>
<thead>
<colgroup>
<col style='width: 750px;'/>
<col style='width: 750px;'/>
<col style='width: 750px;'/>
</colgroup>
</thead>
<tr><td></td><td></td><td><a href='listtree_for_observation.php'>view all trees</a></td></tr></table>";

?>
</td>

<!-- For GMap  
<td class="cms" style="width: 65%; padding-left: 15px;">
<h3>My Trees</h3>
<div id="map" style="margin-left: 8px; position: relative; background-color: rgb(229, 227, 223); display: block;">
</div>
<ul id="list" style="display: none;"></ul>
<div id="message"></div>  
</td>-->
<td class="cms" style="solid rgb(217, 92, 21); width: 50%;">
<h3 align="middle">what are others upto?</h3>
<p>
<?php 
$last_months_date = date("Y-m-d",mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
//echo $last_months_date;
$count_new_trees = mysql_query("SELECT count(tree_id) FROM trees WHERE date_of_addition > '" . $last_months_date . "'");
$row_new_trees = mysql_fetch_array($count_new_trees);
$count_new_observations = mysql_query("SELECT count(observation_id) FROM user_tree_observations WHERE date > '" . $last_months_date . "'");
$row_new_observations = mysql_fetch_array($count_new_observations);
$new_species = mysql_query("SELECT species_primary_common_name, location_master.city, full_name 
FROM trees INNER JOIN (species_master,location_master, user_tree_table, users) 
ON trees.species_id = species_master.species_id AND trees.tree_location_id=location_master.tree_location_id 
AND user_tree_table.tree_id=trees.tree_id AND 
user_tree_table.user_id=users.user_id AND trees.date_of_addition > '" . $last_months_date . "' 
ORDER BY date_of_addition desc LIMIT 0,3;");
$row_new_species = mysql_fetch_array($new_species);
?>
<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;new trees added in the last 1 month: <?php echo $row_new_trees['count(tree_id)']; ?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;new observations in the last 1 month: <?php echo $row_new_observations['count(observation_id)']; ?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;latest species added: <br/>
<table id="table2" class="tablesorter"  cellspacing="0" >
<thead>
<tr>
<td>Species Name</td>
<td>City</td>
<td>Observer</td>
</tr>
</thead>
<?php 
	echo "<tr><td>". $row_new_species['species_primary_common_name'] . "</td><td>".$row_new_species['location_master.city']."</td><td>".$row_new_species['full_name']."</td></tr>"; 
/*$result3 = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='".$row_new_species['species_id']."'");
$image_names = mysql_fetch_array($result3);
$species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
print "<td><img src='$species_pic1' height='110%' width='110%'></td></tr>";  */
	
	$row_new_species = mysql_fetch_array($new_species);
	echo "<tr><td>". $row_new_species['species_primary_common_name']. "</td><td>".$row_new_species['city']."</td><td>".$row_new_species['full_name']."</td></tr>"; 
	
	$row_new_species = mysql_fetch_array($new_species);	
	echo "<tr><td>". $row_new_species['species_primary_common_name']. "</td><td>".$row_new_species['city']."</td><td>".$row_new_species['full_name']."</td></tr>"; 
?>
</table>
</td>

</tr>


<tr>
<td colspan="2">
<hr/>
</td>
</tr>
<tr>
<td class="cms" colspan="2">
<h3 align="middle">my observations</h3>
<div align="middle">(weekly, over the previous year)</div>
<p>Choose one of your trees below</p>
<a name="my_observations"></a>
<form method="POST" action=<?php echo $_SERVER['PHP_SELF']."#my_observations";?> name="filterform" onSubmit="return validatelist();"> 
<?php
$tree_id=$_POST['tree_control'];
$sql=mysql_query("SELECT DISTINCT(tree_nickname), user_tree_table.tree_id FROM species_master JOIN (trees, user_tree_table) ON trees.tree_id = user_tree_table.tree_id AND trees.species_id = species_master.species_id AND user_tree_table.user_id = '$_SESSION[user_id]'");

echo "<SELECT name='tree_control' id='tree_control'>";
if($tree_id=='') {
	echo "<option value='0' SELECTED>------Chosse a Tree------</option>";
} else {
	echo "<option value='0'>------Chosse a Tree------</option>";
}
while($row=mysql_fetch_array($sql))
{
if($tree_id==$row['tree_id']) {
	echo "<option value=".$row['tree_id']." SELECTED>".$row['tree_nickname']."</option>";
} else {
	echo "<option value=".$row['tree_id'].">".$row['tree_nickname']."</option>";
}
}
echo "</select>";

//echo $tree_id;
?>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> 
</td>
</form>
<p>
<?php

$end_date=date('Y-m-d');
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
//echo $end_date, $start_date;
echo "<table border='1' width='50%'><tr><td width='7%'></td><td width='1%'></td><td><b>$start_date</b></td><td width='9%'><b>$end_date</b></td></tr></table>";
echo "<table border='1' width='50%'>";
echo "<tr><td>Fresh Leaves: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_leaf_fresh) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_leaf_fresh']."<br/>";

if($row_settings['is_leaf_fresh']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_leaf_fresh']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";

echo "<tr><td colspan=12></td></tr>";
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo "<tr><td>Mature Leaves: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_leaf_mature) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_leaf_mature']."<br/>";

if($row_settings['is_leaf_mature']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_leaf_mature']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";
echo "<tr><td colspan=12></td></tr>";
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo "<tr><td>Flower Buds: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_flower_bud) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_fruit_unripe']."<br/>";

if($row_settings['is_flower_bud']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_flower_bud']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";
echo "<tr><td colspan=12></td></tr>";
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo "<tr><td>Open Flowers: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_flower_open) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_fruit_unripe']."<br/>";

if($row_settings['is_flower_open']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_flower_open']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";


echo "<tr><td colspan=12></td></tr>";
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo "<tr><td>Unripe Fruit: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_fruit_unripe) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_fruit_unripe']."<br/>";

if($row_settings['is_fruit_unripe']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_fruit_unripe']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";
echo "<tr><td colspan=12></td></tr>";
$m= date("m"); // Month value
$de= date("d"); //today's date
$y= date("Y")-1; // Year value
$start_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y)); 
echo "<tr><td>Ripe Fruit: </td>";
while ($start_date <= $end_date)
{
//echo $start_date;
$de+=7;
$next_week_date= date('Y-m-d', mktime(0,0,0,$m,$de,$y));
//echo $next_week_date;

$user_tree_table_settings = mysql_query("SELECT DISTINCT(user_tree_observations.is_fruit_ripe) 
	   FROM user_tree_observations INNER JOIN (users, user_tree_table, trees,species_master)
	   ON user_tree_table.user_tree_id = user_tree_observations.user_tree_id 
	   AND user_tree_table.user_id='$_SESSION[user_id]' 
	   AND users.user_id=user_tree_table.user_id 
	   AND user_tree_table.tree_id=trees.tree_id 
	   AND trees.species_id=species_master.species_id
	   AND user_tree_table.tree_id='$tree_id'
	   AND user_tree_observations.date >='$start_date'
	   AND user_tree_observations.date <='$next_week_date'
       ORDER BY user_tree_observations.date");

$row_settings = mysql_fetch_array($user_tree_table_settings);

//echo "in the inner loop";
//echo $row_settings['is_fruit_unripe']."<br/>";

if($row_settings['is_fruit_ripe']=='0')
{
echo "<td bgcolor='red'></td>";
}
elseif($row_settings['is_fruit_ripe']=='1')
{
echo "<td bgcolor='green'></td>";
}
else
{
echo "<td bgcolor='white'></td>";
}

$start_date=$next_week_date;
}
echo "</tr>";

echo "<tr><td><br/></td></tr>";
echo "</table>";
echo "<table style='width:70%;'>";
echo "<tr>";
echo "<td>Color Legend: </td>
<td bgcolor='white' width='25%'>No Data / Don't Know</td>
<td bgcolor='red' width='23%'>No</td>
<td bgcolor='green' width='23%'>Yes</td>";
echo "</tr>";
echo "</table>";
//echo "out of loop";
?>

</p>
</td>
</tr>
</tbody>
</table>
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

