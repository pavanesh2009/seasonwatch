<?php 
include './includes/dbc.php';
page_protect();

//print_r($HTTP_POST_VARS);

$speciesId=($_POST['species_id']);
$getlocationname= $_SESSION['treelocID']; 
//echo $_POST['treelocationname'];
//echo $getlocationname;

if($_POST['Submit'] == 'Submit')  
{                     foreach($_POST as $key => $value)
{ 
$data[$key] = filter($value);
} 
$dfw_fieldname="";
$dfw_value="";
$dos_fieldname="";
$dos_value="";
 if($_POST[distance_from_water]!="")
 {
 $dfw_fieldname="distance_from_water,";
 $dfw_value="'$_POST[distance_from_water]',";
 }
 if($_POST[degree_of_slope]!="")
 {
 $dos_fieldname="degree_of_slope,";
$dos_value="'$_POST[degree_of_slope]',";
 }
$sql1 = "INSERT INTO trees  
              (tree_desc,is_fertilised,
              is_watered,species_id,tree_location_id,location_type,".$dfw_fieldname.$dos_fieldname." aspect,date_of_addition)  
              VALUES
              ('$_POST[tree_desc]',
              '$_POST[is_fertilised]',
              '$_POST[is_watered]',  
              '$speciesId',  
              '$_SESSION[treelocID]', 
              '$_POST[location_type]',".
               $dfw_value.$dos_value." 
              '$_POST[aspect]',
				CURDATE()
              )";  
              mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 

//echo "ID of last inserted record is: " . mysql_insert_id();
$tree_id = mysql_insert_id();
//echo "$tree_id"; 
if ($_POST[assigned_user]){
	$user_to_assign=$_POST[assigned_user];
}
else {
	$user_to_assign=$_SESSION[user_id];
}
$sql2 = "INSERT INTO user_tree_table 
         (tree_id,tree_nickname,user_id) 
         VALUES
         ('$tree_id', 
         '".addslashes($_POST[tree_nickname])."',
         '$user_to_assign'
         )"; 
       mysql_query($sql2,$link) or die("Insertion Failed2:" .mysql_error()); 

//echo "tree damage".$_POST[tree_damage];
$sql3 = "INSERT INTO tree_measurement  
	            (tree_id,user_id,date_of_measurement,";
 if($_POST[tree_girth]!="")
 {
 $sql3 .= "tree_girth,";
 }           
 if($_POST[tree_height]!="")
 {
 $sql3 .= "tree_height,";
 }  
 $sql3 .= "tree_damage,other_notes) 
               VALUES 
               ('$tree_id',
               '$_SESSION[user_id]',
               now(),";
if($_POST[tree_girth]!="")
 {
 $sql3 .= "'".addslashes($_POST[tree_girth])."',";
 }           
 if($_POST[tree_height]!="")
 {
 $sql3 .= "'".addslashes($_POST[tree_height])."',";
 }  
 $sql3 .= "		'".addslashes($_POST[tree_damage])."', 
               '".addslashes($_POST[other_notes])."' 
               )";    
					mysql_query($sql3,$link) or die("Insertion Failed3:" .mysql_error()); 

//echo "Done id: ".$row.". <br />"; 
}

//after insertion unset the session for treelocation 

unset($_SESSION['treelocation']); 
?>  
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

<table id="table1" class="tablesorter" cellspacing="0" cellpadding="3" style="width: 500px; margin-left: auto; margin-right: 50%;">
<colgroup>
<col style="width: 150px;"/>
<col style="width: 3500px;"/>
<col style="width: 350px;"/>
<col style="width: 400px;"/>
</colgroup>
<thead>
<tr>
<th class="header">Tree Nickname</th>
<th class="header">Primary Name</th>
<th class="header">Scientific name</th>
<th class="header">Family</th>
<th class="header">Tree Location</th>
</tr>
</thead>
<tbody>

<?php 
print "<tr class='delboxtr'>";
print "<tr>";

$tree_nickname=$_POST['tree_nickname'];
echo "<td>" . $tree_nickname . "</td>";

$species_scientific_nameID=$_POST['species_id'];
$query1 = mysql_query("SELECT * FROM species_master WHERE species_id=$species_scientific_nameID");
while($row_settings = mysql_fetch_array($query1)) 
{
echo "<td>" . $row_settings['species_primary_common_name'] . "</td>";
echo "<td>" . $row_settings['species_scientific_name'] . "</td>";
echo "<td>" . $row_settings['family'] . "</td>";
}

$query = mysql_query("SELECT * FROM location_master WHERE tree_location_id='$_SESSION[treelocID]'");
while($row = mysql_fetch_array($query)) 
{
$getlocationname = $row['location_name'];
}
echo "<td>" . $getlocationname . "</td>";

print "</tr>";
echo "</tbody></table>";
mysql_close($link);
?>

<html> 
<p align="center"> 
<input type=reset  value="Add a new tree"  class=buttonstyle onclick="javascript:window.location.href='addtree_options.php';">
&nbsp;&nbsp;
<input type=reset  value="Edit tree details"  class=buttonstyle onclick="javascript:window.location.href='listtree.php';">
</p>
</div>
</div>
<div class="container bottom">
</div>
<?php 
   include("footer.php");
?>
</body>
</html>