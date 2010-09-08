<?php
include_once("functions.php");
include './includes/dbc.php';
$q = strtolower($_GET["q"]);
if (!$q) return;

$result3 = mysql_query("SELECT path_name,file_name FROM species_images WHERE species_id='$q'");
$image_names = mysql_fetch_array($result3);
$species_pic1 = $image_names['path_name'].$image_names['file_name'];
$image_names = mysql_fetch_array($result3);
//$species_pic2 = $image_names['path_name'].$image_names['file_name'];
//if (file_exists($filename)) {
//    echo "The file $filename exists";
?>
<table>
<tr>
<td></td>
<td style="text-align:right;">
<?php

$result2 = mysql_query("SELECT * FROM species_master WHERE species_id < '$q' ORDER BY species_id DESC LIMIT 1");
if ($result2) {
if(mysql_num_rows($result2)) {
	echo "<a id='prev_link' onClick=getSpecies('" . strval(intval($q)-1) . "');>Prev</a>";
}
else { echo "Prev";}
}
else { echo "Prev";}
$result3 = mysql_query("SELECT * FROM species_master WHERE species_id > '$q' ORDER BY species_id ASC LIMIT 1");
echo " | ";
if ($result3) {
echo "<a id='next_link' onClick=getSpecies('" . strval(intval($q)+1) . "');>Next</a>";
}
else { echo "Next";}

?>
</td>

</tr>
<tr>
<td>
<?php print"<a href='$species_pic1?TB_iframe=true' title='click to view larger image' class='thickbox' ><img src ='".return_thumbnail($species_pic1)."' /></a>"; ?>
</td>

<?php 
$result = mysql_query("SELECT * FROM species_master WHERE species_id='$q'");
while ($row_settings = mysql_fetch_array($result)) 
{
print "<td style='text-align: top;'>Tree Name: " .$row_settings['species_primary_common_name']."<br/>";
print "Scientific Name:<i> ".$row_settings['species_scientific_name']. "</i><br/>";
print "Family: ".$row_settings['family']."</td>";
}
?>
</tr>

</table>
<?php mysql_close($link);?>