<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
   	include_once("includes/dbc.php");
?>


<body>
<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;width:500px;">
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

<!-- Select tree data and display in editable fashion -->
<table style="width: 500px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
<td class="cms" style="border-bottem: 1px solid rgb(217, 92, 21); width: 45%;">
<form action="reassignuser_db.php" method="POST" name="species" id= "species">
<input type = "hidden" name="tree_id" value=<? echo $_GET[treeid]; ?>/>
<input type = "hidden" name="old_user_id" value=<? echo $_GET[assigned_user]; ?>/>
<div align="center">
<table width=460px cellpadding=6 cellspacing=2>
</div>
<tr>
<td colspan="2"><b>Reassign to another group member</b>
<br/><br/></td>
</tr>
<?php
$sql="SELECT trees.tree_id, tree_nickname, species_scientific_name, species_primary_common_name, user_tree_table.user_tree_id FROM species_master INNER JOIN (trees INNER JOIN user_tree_table ON trees.tree_id = user_tree_table.tree_id AND user_tree_table.user_id  IN (select users.user_id from users where users.group_id='$_SESSION[group_id]')) ON species_master.species_id = trees.species_id AND trees.tree_id='".$_GET[treeid]."';";
$user_tree_table_settings = mysql_query($sql);
while ($row_settings = mysql_fetch_array($user_tree_table_settings)) 
{
//print $row_settings['species_primary_common_name'];  
 
//print $row_settings['tree_id'];
print "<tr><td><b>Primary Common Name</b></td><td>".$row_settings['species_primary_common_name']."</td></tr>";
print "<tr><td><b>Scientific Name</b></td><td><i>".$row_settings['species_scientific_name']. "</i></td></tr>";
print "<tr><td><b>Tree Nickname</b></td><td>".$row_settings['tree_nickname']."</td></tr>";
?>
<tr> 
<td align=right>Group Member to Assign Tree to<font color="#CC0000">*</font></td>
<td>
<?php
$sql = mysql_query("SELECT full_name, user_id FROM users WHERE group_id='$_SESSION[group_id]' ORDER BY user_id;");
echo "<select name='assigned_user' id='assigned_user' class='required'>";
while($row=mysql_fetch_array($sql))
{
if($row['user_id']==$_GET[assigned_user]) {
	echo "<option value=".$row['user_id']." selected >".$row['full_name']."</option>";
} else {
	echo "<option value=".$row['user_id'].">".$row['full_name']."</option>";
}
}
echo "</select>";
?>
<div1 id="tooltiptest">
<a title="Please assign this tree to the group member you want this tree to be observed by." href="#">(?)</a>
</div>
</td>
</tr>
<? } ?>

<tr>
<td colspan=2 align=center>
<p align="center">
<input name="doUpdate" type="submit" id="doUpdate" value="Update">
&nbsp;&nbsp;
<input type=reset  value="Cancel"  class=buttonstyle onclick="javascript:window.top.tb_remove();">
</p>
<br/>
</td>
</tr>
</table>
</table>
</form>
</div>
</div>
<?php mysql_close($link);?>
</body>
</html>
