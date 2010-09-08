<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>


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

<!--for emptyonclick-->
<script type="text/javascript" src="js/jquery.emptyonclick.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.emptyonclick').emptyonclick();
});
</script>

<script type="text/javascript">
function validatelist(thisform)
{
if(document.speciessearch.speciesid.value == 0)
{
alert("Please choose a valid tree name!!");
return false;
}
return true;
}
</script>

<script type="text/javascript">
function validatebox(firstform)
{
//alert('coming');
if((document.search_frm.speciesname.value == "Type your tree name")||(document.search_frm.speciesname.value == ""))
{
alert("Please type a tree name!");
return false;
}
if(document.search_frm.speciesid.value == "speciesname")
{
alert("Please type a valid tree name!");
return false;
}
return true;
}
</script>



<body>
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



<!-- <h3>Identify a species using any of the 3 options below</h3> -->
<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>&nbsp;&nbsp;&nbsp;&nbsp;</tr>
<tr><td class="cms">
This list contains only those species selected for being
monitored under SeasonWatch. If you want to suggest additional species
for this list, please write to sw@seasonwatch.in
</td>
</tr>
<tr>&nbsp;&nbsp;</tr>

<tr>
<td  width="450px">
<h3>Add a Tree through Keyword Search</h3>

<div id="content"> 
<form name="search_frm" action="addtreeconfirm.php" method="POST" autocomplete="off" onSubmit="return validatebox();">
<input type="hidden" name="speciesid" id="speciesid" value="speciesname"/>
<p>
Tree Name
<input id="speciesname" class="emptyonclick" class="ac_input" type="text" name="speciesname" autocomplete="off" value="Type your tree name" />
<!--<input type="button" value="Get Value"/>-->
<input type="submit"  name="Submit" id="Submit" value="Submit"> 
</p>
</form>
</div>


<!--<tr>
<form name="kwdsearch" method="POST" action="keywordsearch.php">
<p>2. Find a Species through Leaf Type </p>
Feathered <input type="radio" name="leaf_type"/><br/>
Camel's Hoof-shaped<input type="radio" name="leaf_type"/><br/>
Plamately compund<input type="radio" name="leaf_type"/><br/>
Feather compound<input type="radio" name="leaf_type"/>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> 
</form>
<br/><br/><br/>
</tr>-->

<br/><br/><br/>
</td>
</tr>

<tr>
<td  width="450px">
<h3>Add a Tree by selecting from the list below</h3>
<form name="speciessearch" method="POST" action="addtreeconfirm.php" onSubmit="return validatelist();">
<input type = "hidden" name="species_id" value="name"/>

<!--This is old technique, not required now commented by Pavanesh
<select name="speciesid" onChange="getspecies_scientific_name(this.value);getfamily(this.value);">-->




<select name="speciesid" id="speciesid"><?php 
$sql = mysql_query("SELECT species_id,species_primary_common_name, species_scientific_name FROM species_master ORDER BY species_primary_common_name");
while($row = mysql_fetch_array($sql))
{
$data1.= "<option  value='".$row['species_id']."'>".$row['species_primary_common_name']." (".$row['species_scientific_name'].")</option>";
}  
echo "<option value='0' SELECTED>------Chosse a Tree------</option>";
echo $data1;	
?>

</select>
<input type="submit"  name="Submit" id="Submit" value="Submit" class=buttonstyle> 
&nbsp;&nbsp;
</form>

</td>
</tr>

</tbody>
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
