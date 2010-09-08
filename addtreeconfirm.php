<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");

$speciesname=$_POST['speciesid'];
$_SESSION['speciesid']=$speciesname;

?> 



<body>

<script type="text/javascript">
$().ready(function() {
	$("#speciesname").autocomplete("rpc.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});

	 $("#speciesname").result(function(event, data, formatted) {
    $("#speciesid").val(data[1]);
      });
   	});
</script>


<?php
include ("header.php");
?>

<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>add tree</a></li>
    </ul>
   </div>
<div>
<hr/>
</div>
<h3>Please verify that this is the species you wish to add</h3>

<form name="species_image" method="POST" action="addtree.php">

<input type = "hidden" name="species_id" value="<? echo $speciesname;?>"/>

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
<table class="filter">
<colgroup>
<col style="width: 50px;"/>
<col style="width: 50px;"/>
</colgroup>
<tr>
<td>
<table>
<?php 
$result = mysql_query("SELECT * FROM species_master WHERE species_id='$speciesname'");

while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr><td><font size=+1>Tree Name: " .$row_settings['species_primary_common_name']."</font></td></tr>";
print "<tr><td><font size=+1>Scientific Name:<i> ".$row_settings['species_scientific_name']. "</font></i></td></tr>";
print "<tr><td><font size=+1>Family: ".$row_settings['family']."</font></td></tr>";
}
?>
</table>
</td>
<td>
<table>
<?php 
$result2 = mysql_query("SELECT * FROM species_alternate_name INNER JOIN language_master ON species_alternate_name.language_id = language_master.language_id AND species_alternate_name.species_id='$speciesname'");
$count=0;
while($row_settings2 = mysql_fetch_array($result2))
{
if (!$count){ print "<tr><td><font size=+1><br/>Alternative Names</font></td></tr>";$count++;}
	print "<tr><td><font size=+1>".$row_settings2['Language_name'].": " .$row_settings2['alternative_name']."</font></td></tr>";

}
?>
</table>
</td>
</tr>
</table>

<p align="center">
<input type="submit"  name="Submit" id="Submit" value="Yes, this is the species I want to add" style="width:300">
<input name="doRefresh" type="button" id="doRefresh" value="I'm not sure -- take me back to Tree options" onclick="javascript:window.location.href='addtree_options.php';" style="width:300">
</p>
</form>
</div>
</div>
<div class="container bottom">
</div>
<?php 
   include("footer.php");
?>
</body>
</html>