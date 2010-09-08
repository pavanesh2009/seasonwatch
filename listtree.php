<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>



<script type = "text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
 //alert(delUrl);
 	url = 'listtree.php?id='+delUrl; 
 	//alert(url);
   window.document.location = url;
  }
else
{
url = 'listtree.php';
 window.document.location = url;
}
}
</script>


<body>
<?php 
include ("header.php");
?>

 
<!--delete code from user-->
<?php 
if($_GET['id']!= "")
{ 
$usertreeid=($_GET['id']);  
$sql1 = "DELETE FROM user_tree_table 
               WHERE user_tree_id= '$usertreeid'";  
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error());  
echo "<div class=\"notice\">Successfully Deleted</div>";
} 
?>


<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>edit tree</a></li>
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
<?php if ($_SESSION[group_role]=='coord')
{
?>
<col style="width: 750px;"/>
<? } ?>
<col style="width: 750px;"/>
<col style="width: 650px;"/>
</colgroup>
<thead>
<tr>
<th class="header">No</th>
<th class="header">Primary common Name</th>
<th class="header">Scientific name</th>
<th class="header">Tree Nickname</th>
<?php if ($_SESSION[group_role]=='coord')
{
?>
<th class="header">Assigned to Member</th>
<? } ?>
<th class="header">Edit</th>
<th class="header">Delete</th>

</tr>
</thead>
<tbody>

<?php 
$count=0;
print "<tr class='delboxtr'>";

//$user_tree_table_settings = mysql_query("SELECT tree_nickname, tree_id FROM  user_tree_table WHERE user_id='".$_SESSION[user_id]."'");
if ($_SESSION[group_role]=='coord')
{
	$user_tree_table_settings = mysql_query("SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id  IN (select users.user_id from users where users.group_id='$_SESSION[group_id]')) ON species_master.species_id = trees.species_id ORDER BY trees.tree_id");
}
else
{
		$user_tree_table_settings = mysql_query("SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id='$_SESSION[user_id]') ON species_master.species_id = trees.species_id ORDER BY trees.tree_id");
}
  
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
//print $row_settings['species_primary_common_name'];  
 
//print $row_settings['tree_id'];
print "<tr>";
$count++;  
print "<td style='width:220px'>".$count."</td>";
//$trees_settings = mysql_query("SELECT species_id FROM trees WHERE tree_id='".$row_settings['tree_id']."'");
//print $row_settings['species_id'];
//$species_settings = mysql_query("SELECT species_scientific_name,species_primary_common_name FROM species_master WHERE species_id=".$trees_settings['species_id']);
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td><i>".$row_settings['species_scientific_name']. "</i></td>";
print "<td style='width:220px'>".$row_settings['tree_nickname']."</td>";

if ($_SESSION[group_role]=='coord')
{
$assigned_to_member_rows = mysql_query("SELECT user_tree_table.user_id, full_name 
FROM user_tree_table INNER JOIN users 
ON user_tree_table.user_id = users.user_id AND tree_id='".$row_settings['tree_id']."';");
$assigned_to_member=mysql_fetch_array($assigned_to_member_rows);
	print "<td>$assigned_to_member[full_name]&nbsp;&nbsp;&nbsp;&nbsp;(<a class=thickbox href=\"reassignuser.php?treeid=".$row_settings['tree_id']."&assigned_user=".$assigned_to_member[user_id]."&TB_iframe=true&height=300&width=530\">Change</a>)</td>";
}
$edittreeLink = "<a class=thickbox href=\"edittree.php?treeid=".$row_settings['tree_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>";
//$deletetreelink="<a class=thickbox href=\"deletetree.php?usertreeid=".$row_settings['user_tree_id']."\">Delete</a>";
$var=$row_settings['user_tree_id'];
$deletetreeLink = "<a  href='listtree.php' onclick=confirmDelete('$var');>Delete</a>";
print "<td>$deletetreeLink</td>";
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



