<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");

	if($_POST['speciesid2']) $speciesname=$_POST['speciesid2'];
	elseif ($_GET['speciesid']) $speciesname=$_GET['speciesid'];
	
?> 

<body>


<?php
include ("header.php");
?>

<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>species guide</a></li>
    </ul>
   </div>
<div>
<hr/>
</div>

<table>
<colgroup>
<col style="width: 50px;"/>
<col style="width: 50px;"/>
</colgroup>
<tr>
<td valign="top">
<table>
<?php 
$result = mysql_query("SELECT * FROM species_master WHERE species_id='$speciesname'");

while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr><td>Tree Name: " .$row_settings['species_primary_common_name']."</td></tr>";
print "<tr><td>Scientific Name:<i> ".$row_settings['species_scientific_name']. "</i></td></tr>";
print "<tr><td>Family: ".$row_settings['family']."</td></tr>";
}
?>
</table>
<br/><br/><br/><br/>
</td>
<td>
<table>
<?php 
$result2 = mysql_query("SELECT * FROM species_alternate_name INNER JOIN language_master ON species_alternate_name.language_id = language_master.language_id AND species_alternate_name.species_id='$speciesname'");
$count=0;
while($row_settings2 = mysql_fetch_array($result2))
{
if (!$count){ print "<tr><td><br/>Alternative Names</td></tr>";$count++;}
	print "<tr><td>".$row_settings2['Language_name'].": " .$row_settings2['alternative_name']."</td></tr>";

}
?>
</table>
</td>
</tr>
</table>

<?php
$result3 = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$speciesname'");
$image_names = mysql_fetch_array($result3);
$species_pic1 = $image_names['path_name'].'/'.$image_names['file_name'];
$image_names = mysql_fetch_array($result3);
$species_pic2 = $image_names['path_name'].'/'.$image_names['file_name'];
//if (file_exists($filename)) {
//    echo "The file $filename exists";
?>
<table>
<tr>
<td>
<?php print"<img src ='".$species_pic1."'width='300px' />"; ?>
</td>
<td>
<?php print"<img src ='".$species_pic2."'width='300px' />"; ?>
</td>
</tr>
</table>
</div>
</div>
<div class="container bottom">
</div>
<?php 
   include("footer.php");
?>
</body>
</html>