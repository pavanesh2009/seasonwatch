<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>

<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
function getspecies_scientific_name(species_id) {		
	//alert("speciesID : "+ species_id);
	   var strURL="tracktrees.php?species_id="+species_id;
	   document.species.species_id.value = species_id;
	    
	    var strURL="edittree.php?species_id="+species_id;
	   document.species.species_id1.value = species_id;
	  // alert(document.species.species_id1.value);

	  	//alert(document.species.species_id.value);
	  //alert(strURL);
	
	var strURL="findscientific_name.php?primary_name="+species_id;
		//alert(strURL);
		var req = getXMLHTTP();
if (req) {
			req.onreadystatechange = function() {
			if (req.readyState == 4) {
			//alert("onreadystatechange ==4");
			// only if "OK"
			//HTTP Request req.status ==200 shows 'Everything is OK' commented by Pavanesh
if (req.status == 200) {						
		document.getElementById('species_scientific_namediv').innerHTML=req.responseText;						
			} else {
			alert("There was a problem while using XMLHTTP:\n" + req.statusText);
			}
			}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}

function getfamily(species_id1) {
	//alert("primary_name=" + species_id1 );		
	var strURL="findfamily.php?primary_name="+species_id1;
	var req = getXMLHTTP();
if (req) {   req.onreadystatechange = function() {
	if (req.readyState == 4) {
	// only if "OK"
	if (req.status == 200) {						
	document.getElementById('familydiv').innerHTML=req.responseText;						
	}
else {
	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
   	}
		}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
}
}
function make_blank()
{
document.species.tree_desc.value ="";
}
</script>

<!-- script for accesing session info through AJAX -->
<script type="text/javascript">
function getlocname() {
//alert('in getlocname');
	var req = getXMLHTTP();
if (req) {   req.onreadystatechange = function() {
	if (req.readyState == 4) {
	// only if "OK"
	if (req.status == 200) {						
	document.getElementById('treelocationname').value=req.responseText;						
	}
else {
	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
   	}
		}				
		}			
		req.open("GET", "return_session_locname.php", true);
		req.send(null);
}
}
</script>

<!--<script type="text/javascript">
$(function() {
$('#tooltiptest a').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	showBody: " - ",
	fade: 250
});
});
</script>-->





<script type="text/javascript">
function validate_form(thisform)
{
var height;
height = document.getElementById("tree_height").value;
var girth;
girth = document.getElementById("tree_girth").value;
var distance;
distance = document.getElementById("distance_from_water").value;
var slope;
slope = document.getElementById("degree_of_slope").value;
var nick_name;
nick_name = document.getElementById("tree_nickname").value;


if (height != '' )
{
//alert("The value is "+height);
var numericExpression = /^[0-9]+$/;
	if(height.match(numericExpression) && (height>0 && height<=50)){
//	return true;
}
else{
		alert("tree height value should be Numeric & between 1 to 50");
		document.getElementById("tree_height").focus();
		return false;
}
} 

if(girth != '' )
{
//alert("Hello");
//alert("The value of girth is "+girth);
var numericnew= /^[0-9]+$/;
	if(girth.match(numericnew) && (girth>4 && girth<=10000)){
	//return true;
}
else{
		alert("tree girth value should be Numeric & between 5 to 10000");
		document.getElementById("tree_girth").focus();
		return false;
}
} 

if(distance != '' )
{
var numericdistance= /^[0-9]+$/;
	if(distance.match(numericdistance)){
	//return true;
}
else{
		alert("Distance value should be Numeric");
		document.getElementById("distance_from_water").focus();
		return false;
}
} 

if(slope != '' )
{
var numericslope= /^[0-9]+$/;
	if(distance.match(numericslope) && (slope>=0 && slope<=90))
{
}
else
{
alert("Slope value should be Numeric & between 0 to 90");
document.getElementById("degree_of_slope").focus();
return false;
}
} 


for (i=0; i <= document.species.nicknames.length - 1;i++)
{
if(nick_name == document.species.nicknames[i].text )
{
	alert("Nick name should be unique. Please change the nick name.");
	document.getElementById("tree_nickname").focus();
	return false;
}
}


return true;
}
</script>


<script type="text/javascript">
$(document).ready(function() {
	$("#species").validate();
});
</script>

<!-- <script type="text/javascript">
function setLocation(){
alert("in setLocation");
}
</script> -->


<!--<?php
if ($_POST['speciesid'] == undefined)
{
$query=mysql_query("SELECT species_id FROM species_master ORDER BY species_id ASC limit 1");
while($row = mysql_fetch_array($query))
$speciesid=mysql_insert_id();	
}
else 
{
$speciesid=$_POST['species_id'];	
}
?>-->
<?
$speciesid=$_SESSION['speciesid'];
//echo $speciesid;
?>
<body onLoad="getspecies_scientific_name(<? echo $_SESSION['speciesid'];?>);getfamily(<? echo $_SESSION['speciesid']; ?>);" onfocus="getlocname();">
<?php
include ("header.php");
?>
<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>add tree</a></li>
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

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>

<tr>
<td class="cms" style="border-bottem: 1px solid rgb(217, 92, 21); width: 45%;">
<form action="tracktrees.php" method="POST" name="species" id= "species" onsubmit="return validate_form(this);">
<input type = "hidden" name="species_id" value="name"/>
<input type = "hidden" name="species_id1" value="name"/>

<div align="center">
<table width=585 cellpadding=6 cellspacing=2>
</div>

<p>Please use the form below to enter part of the name of a species, and choose from the options that appear.</p>

<tr>
<td><b>Add Tree for Observation</b></td>
</tr>
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 
<tr>&nbsp;</tr> 

<tr>
<td width="150">Primary Common Name<font color="#CC0000">*</font></td>
<td  width="150">
<?php
$sql = mysql_query("SELECT species_id,species_primary_common_name FROM species_master WHERE species_id='$_SESSION[speciesid]'");
while($row=mysql_fetch_array($sql))
{
if ($row['species_id'] == $speciesid)
{ 
?>
<input type="text" readonly="readonly" value='<?=$row['species_primary_common_name']?>' style="width:200px;"/>
<?php 
}
else
{
?>
<input type="text" readonly="readonly" value='<?=$row['species_primary_common_name']?>' style="width:200px;"/>
<?php 
}
}
?> 
<div1 id="tooltiptest">
<a title="The list contains only those species that have been selected for monitoring under SeasonWatch. Sorry if the tree you are trying to add is not on this list." href="#">(?)</a>
</div>
</td>
</tr>
<tr style="">

<td>Scientific Name<font color="#CC0000">*</font></td>
<td ><div id="species_scientific_namediv"><input type="text"  name="species_scientific_name" readonly="readonly">
</input></div></td>
</tr>
<tr style="">

<td>Family<font color="#CC0000">*</font></td>
<td ><div id="familydiv"><input type="text" readonly="readonly"  name="family"></input></div></td>
</tr>


<tr> 
<td align=right>Tree Location<font color="#CC0000">*</font></td>
<?php
 //echo "treelocation = ". $_SESSION['treelocation'];
 ?>
 <!-- simple add class="ac_input" after class="required"--> 
<td>
<!-- <input type="text" id="treelocationname" readonly="readonly" class="required" name="treelocationname" autocomplete="off" style="width:200px;" 
onfocus="setLocation();"></input> -->
<!--<div id="treelocationname">-->
<input type="text" id="treelocationname" name="treelocationname" readonly="readonly" disabled class="required" name="treelocationname" autocomplete="off" style="width:200px;"></input>
<!--</div>-->
<!-- "<?php 
//echo $_SESSION['treelocation'];
//unset($_SESSION['treelocation']);
?>" -->
<a style="font-size: 13px;" title="Add a new location" class="thickbox" href="addnewlocation.php?&amp;height=500&amp;width=800&amp;TB_iframe=true">
Choose from a map</a>
&nbsp;<div1 id="tooltiptest">
<a title="Use a map to tell us where your tree is" href="#">(?)</a>
</div>
</td>
</tr> 

<tr> 
<td align=right>Location Type</td>
<td>
<select id="location_type" name="location_type" class="required">
<option name="Choose" value="Choose">-- Choose --</option>
<option name="Garden/Park" value="Garden/Park">Garden/Park</option>
<option name="Avenue" value="Avenue">Avenue</option>
<option name="Forest" value="Forest">Forest</option>
<option name="Campus" value="Campus">Campus</option>
<option name="Marsh" value="Marsh">Marsh</option>
<option name="Grassland" value="Grassland">Grassland</option>
<option name="Plantation" value="Plantation">Plantation</option>
<option name="Farmland" value="Farmland">Farmland</option>
<option name="Other" value="Other">Other</option>
</select>
</td>
</tr> 

<?php
$sql = mysql_query("SELECT tree_nickname FROM user_tree_table WHERE user_id='$_SESSION[user_id]'");
echo "<select name='nicknames' id='nicknames' style='visibility:hidden;'>";
while($row=mysql_fetch_array($sql))
{
echo "<option>".$row['tree_nickname']."</option>";
}
echo "</select>";
?>

<tr> 
<td align=right>Tree Nickname<font color="#CC0000">*</font></td>
<td><input type="text" id="tree_nickname" name="tree_nickname" class="required" style="width:200px;">
<div1 id="tooltiptest">
<a title="Please give all your trees a unique nickname. This will help you distinguish your individual trees (e.g. “Home_Neem” from “Street_Neem”) later at the time of adding observations." href="#">(?)</a>
</div>
</td>
</tr> 



<tr> 
<td align=right>Height of the tree (m)</td>
<td><input type="text" id="tree_height" name="tree_height" style="width:200px;">
<div1 id="tooltiptest">
<a title="Note the approximate height of the tree if possible. This can be visually approximated, or by using the height of a known reference in the vicinity (a building or pole that can be measured)." href="#">(?)</a>
</div>
</td>
</tr> 


<tr> 
<td align=right>Girth of the Tree (cm)</td>
<td><input type="text" id="tree_girth" name="tree_girth" style="width:200px;">
<div1 id="tooltiptest">
<a title="The girth of your tree can be measured using a simple flexible measuring-tape. Select the main trunk of the tree at chest-height (approx 1.4mt or 4.5feet from the ground) and measure the girth (circumference) in cm. You can also use a length of string and measure it with a ruler." href="#">(?)</a>
</div>
</td>
</tr> 

<tr> 
<td align=right>Any damage to the tree</td>
<td>
<input type="radio" class="radio" name="tree_damage" value="1" /> Yes
&nbsp;
<input type="radio" class="radio" name="tree_damage" value="2" /> No
<div1 id="tooltiptest">
<a title="Please make a note of any apparent infections by fungus, bacteria or worms on the tree. Also note if you find that the tree has been lopped." href="#">(?)</a>
</div>
<br/>
</td>
</tr>


<tr> 
<td align=right>Is this tree fertilised</td>
<td>
<input type="radio" class="radio" name="is_fertilised" value="1" /> Yes
&nbsp;
<input type="radio" class="radio" name="is_fertilised" value="2" /> No
<div1 id="tooltiptest">
<a title="Many trees in parks, gardens and campuses are regularly fertilized – this affects the phenology of the tree and therefore must be noted." href="#">(?)</a>
</div>
<br/>
</td>
</tr>


<tr> 
<td align=right>Is this tree watered</td>
<td>
<input type="radio" class="radio" name="is_watered" value="1" /> Yes
&nbsp;
<input type="radio" class="radio" name="is_watered" value="2" /> No
<div1 id="tooltiptest">
<a title="Many trees in parks, gardens and campuses are regularly watered – this affects the phenology of the tree and therefore must be noted." href="#">(?)</a>
</div>
<br/>
</td>
</tr>

<!--<tr> 
<td align=right>Tree Location</td>
<td><input type="text" name="tree_location" style="width:200px;"></td>
</tr>--> 

<tr> 
<td align=right>Distance from Water (m)</td>
<td><input type="text" id="distance_from_water" name="distance_from_water" style="width:200px;">
<div1 id="tooltiptest">
<a title="Please note the approximate distance of the plant from any major water source such as lake, river, stream, nala, pond, etc." href="#">(?)</a>
</div>
</td>
</tr> 


<tr> 
<td align=right>Degree of slope(°)</td>
<td><input type="text" id="degree_of_slope" name="degree_of_slope" style="width:200px;">
<div1 id="tooltiptest">
<a title="If your plant is on a hill, try to note the incline of the slope in degree by visual estimation (e.g. slope of 20°). " href="#">(?)</a>
</div>
</td>
</tr>

<tr> 
<td align=right>Aspect</td>
<td>
<select id="aspect" name="aspect">
<!-- <option value="Don't Know">Don't Know</option> -->
<option name="North" value="North">North</option>
<option name="NorthEast" value="NorthEast">North-East</option>
<option name="East" value="East">East</option>
<option name="SouthEast" value="SouthEast">South-East</option>
<option name="South" value="South">South</option>
<option name="SouthWest" value="SouthWest">South-West</option>
<option name="West" value="West">West</option>
<option name="NorthWest" value="NorthWest">North-West</option>
</select>
<div1 id="tooltiptest">
<a title="If your plant is on a hill, please try and note the direction (aspect) to which the hill slope faces (e.g. South-West)" href="#">(?)</a>
</div>
</td>
</tr>

<tr> 
<td align=right>Tree Description</td>
<td><textarea id="tree_desc" class="emptyonclick" name="tree_desc" cols="40" rows="5" autocomplete="off" onClick="document.getElementById('tree_desc').innerHTML='';">
Enter your comments here
</textarea><br> </td>
</tr>

<tr> 
<td align=right>Other Notes</td>
<td><textarea id="other_notes" name="other_notes" class="emptyonclick"  onClick="document.getElementById('other_notes').innerHTML='';">
Enter your comments here
</textarea><br> </td>
</tr>
<?php
if ($_SESSION[group_role]=='coord')
{
?>
<tr> 
<td align=right>Group Member to Assign Tree to<font color="#CC0000">*</font></td>
<td>
<?php
$sql = mysql_query("SELECT full_name, user_id FROM users WHERE group_id='$_SESSION[group_id]' ORDER BY user_id;");
echo "<select name='assigned_user' id='assigned_user' class='required'>";
echo "<option value='' selected>Select a Group member</option>";
while($row=mysql_fetch_array($sql))
{
	echo "<option value=".$row['user_id'].">".$row['full_name']."</option>";
}
echo "</select>";
?>
<div1 id="tooltiptest">
<a title="Please assign this tree to the group member you want this tree to be observed by." href="#">(?)</a>
</div>
</td>
</tr>
<? } ?>
</table>

<p align="center">
<input type="submit"  name="Submit" id="Submit" value="Submit" /> 
&nbsp;&nbsp;
<input type=reset  value="Clear"  class=buttonstyle/>
&nbsp;
<input type=reset  value="Cancel"  class=buttonstyle onclick="javascript:window.location.href='addtree_options.php';"/>
</p>

</table>
</form>
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