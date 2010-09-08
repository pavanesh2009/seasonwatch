<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>



<body>

<?php 
include ("header.php");
?>
<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>add observation</a></li>
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

<table id="table1" class="tablesorter" cellspacing="0" cellpadding="3" style="width: 930px; margin-left: auto; margin-right: auto;">
<colgroup>
<col style="width: 5px;"/>
<col style="width: 750px;"/>
<col style="width: 650px;"/>
<col style="width: 750px;"/>
<col style="width: 750px;"/>
<col style="width: 750px;"/>
</colgroup>
<thead>
<tr>
<th class="header">No</th>
<th class="header">Species Primary Name</th>
<th class="header">Species scientific name</th>
<th class="header">Tree Nickname</th>
<th class="header">Last Obervation</th>
<th class="header">Observations</th>
</tr>
</thead>
<tbody>

<?php 
$count=0;
print "<tr class='delboxtr'>";
if ($_SESSION[group_role]=='coord')
{
	$user_tree_table_settings = mysql_query("SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id, user_tree_table.last_observation_date FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id  IN (select users.user_id from users where users.group_id='$_SESSION[group_id]')) ON species_master.species_id = trees.species_id ORDER BY user_tree_table.last_observation_date ASC;");
}
else
{
		$user_tree_table_settings = mysql_query("SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id, user_tree_table.last_observation_date 
		FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id ='$_SESSION[user_id]') ON species_master.species_id = trees.species_id ORDER BY user_tree_table.last_observation_date ASC;");
}	
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
print "<tr>";
$count++;  
print "<td style='width:220px'>".$count."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td><i>".$row_settings['species_scientific_name']. "</i></td>";
print "<td style='width:220px'>".$row_settings['tree_nickname']."</td>";
print "<td style='width:220px'>".$row_settings['last_observation_date']."</td>";
$treeLinkBegin = "<a class=thickbox rel=gallery-plants href=\"userobservations.php?usertreeid=".$row_settings['user_tree_id']."&TB_iframe=true&height=500&width=700\">Add</a>";

print "<td>$treeLinkBegin</td>";

print "</tr>";
}  

/*
 $species_ID=($_GET['id']); 

$trees_settings = mysql_query("SELECT tree_location FROM trees WHERE species_id='$species_ID'"); 

$species_settings = mysql_query("SELECT species_scientific_name,species_primary_common_name,family FROM species_master WHERE species_id='$species_ID'");

while ($row2_settings = mysql_fetch_array($species_settings)) 
{

print "<td>".$row2_settings{'species_primary_common_name'}."</td>";
print "<td>".$row2_settings['species_scientific_name']. "</td>";
print "<td>".$row2_settings['family']. "</td>";
}

while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{ 
print "<td style='width:220px'>".$row_settings['tree_nickname']."</td>";
}

while ($row1_settings = mysql_fetch_array($trees_settings)) 
{
print "<td>".$row1_settings['tree_location']."</td>";
}
 
*/


  
echo "</tbody></table>";


?>
<html> 

<p align="center"> 
<input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">
</p>

<!--<p align="center"> 
<input type=reset  value="Back"  class=buttonstyle onclick="javascript:window.location.href='contrib.php';">
</p>-->
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