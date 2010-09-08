<? 
   session_start();
   $page_title="::: SeasonWatch :::";
   //include("../main_includes.php");
   include("../includes/dbc.php");

if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}


if($_GET['id']!= "")
{ 
$speciesID=($_GET['id']);  
echo $species_id;
$sql1 = "DELETE FROM species_master 
         WHERE species_id= '$speciesID'";  
echo "<div class='notice'>You have to be logged in to access this page</div>";
mysql_query($sql1,$link)or die("Insertion Failed:" .mysql_error()); 
} 
?>
 
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<!--<title>SeasonWatch</title>
<link type="text/css" rel="stylesheet" href="../js/thickbox/thickbox.css"></link>
<script language="javascript" src="../js/thickbox/thickbox.js"></script>
<link rel="stylesheet" href="../blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="../blueprint/print.css" type="text/css" media="print">
<link rel="stylesheet" href="../blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<link rel="stylesheet" href="../css/styles_new.css" type="text/css">
<link type="text/css" rel="stylesheet" href="../js/thickbox/thickbox.css"></link>
<script language="javascript" src="../js/thickbox/thickbox.js"></script>

alerts script
<script src="js/jquery.js" type="text/javascript"></script>
<script src="/js/alerts/jquery.ui.draggable.js" type="text/javascript"></script>
Core files 
<script src="/js/alerts/jquery.alerts.js" type="text/javascript"></script>
<link href="/js/alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />-->

<?php
include ("../main_includes.php");
?>

<script type = "text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete")) {
 //alert(delUrl);
 	url = 'listspecies.php?id='+delUrl; 
   window.document.location = url;
  }
else
{
url = 'listspecies.php';
 window.document.location = url;
}
}
</script>
<script type="text/javascript">
        $(function() { 

             $("#table1")
                .tablesorter({  headers: { 
                   5: { sorter: false }, 6: { sorter: false }, 7 : { sorter: false }, 8: { sorter: false } },widthFixed: true, widgets: ['zebra']})
                   .tablesorterPager({container: $("#pager"), positionFixed: false});

              $("#table2")
                .tablesorter({widthFixed: true, widgets: ['zebra']})
                .tablesorterPager({container: $("#pager2"), positionFixed: false});
                     
        });
    </script> 

</head>

<body>
<div class='container first_image'>
<table>
<tr>
<td><b><h3>All Species list</h3></b></td>
</tr>
</table>
<div>
<hr>
</div>
<table style="width: 930px; margin-left: auto; margin-right: auto;">

<tbody><tr>
<td>
<a href="admin.php" title="species_page">
<img alt="" src="./images/cpanel.png">cpanel</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>


<td>
<a href="species_page.php" title="species_page">
<img alt="" src="./images/addedit.png">Add new species</a>
&nbsp;

&nbsp;
&nbsp;
&nbsp;
</td>

<td>
<a href="listspecies.php" title="species_page">
<img alt="" src="./images/address_f2.png">All Species List</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>

<td>
<a href="listusers.php" title="species_page">

<img alt="" src="./images/icon-48-user.png">User Manager</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
</td>


<td>
<a href="admin_logout.php" title="species_page">
<img alt="" src="./images/logout.png">Logout</a>
&nbsp;
&nbsp;
&nbsp;
&nbsp;

</td>

<div class='container first_image'>
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

<div>      
<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:30px'>S No.</th>
                                <th style='width:80px'>Species ID</th>           
                                <th style='width:150px'>Species Primary Name</th>
                                <th style='width:150px'>Species Scientific Name</th>                        
				<th style='width:200px'>Family</th>
<th style='width:150px'>Edit</th>
<th style='width:150px'>Delete</th>
  </tr>
                </thead>
<tbody>


<?php 
$count=0;
$result = mysql_query("SELECT species_id,species_primary_common_name, species_scientific_name,family FROM species_master");
while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr>"; 
$count++; 
print "<td style='width:56px'>".$count."</td>";
//print $row_settings['species_id'];
print "<td>".$row_settings['species_id']."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['species_scientific_name']. "</td>";
print "<td style='width:220px'>".$row_settings['family']."</td>";
$edittreeLink = "<a class=thickbox href=\"editspecies.php?speciesid=".$row_settings['species_id']."&TB_iframe=true&height=500&width=700\">Edit</a>";
print "<td>$edittreeLink</td>"; 

$var=$row_settings['species_id'];
$deletetreeLink = "<a  href='listspecies.php' onclick=confirmDelete('$var');>Delete</a>";
//$deletetreeLink = "<a  href='listspecies.php?id=$var' >Delete</a>";
print "<td>$deletetreeLink</td>";
print "</tr>";  
}  
echo "</tbody></table>";
?>
<div id="pager" class="column span-7" style="" >
                        <form name="" action="" method="post">
                                <table >
                                <tr>
                                        <td><img src='pager/icons/first.png' class='first'/></td>
                                        <td><img src='pager/icons/prev.png' class='prev'/></td>
                                        <td><input type='text' size='8' class='pagedisplay'/></td>
                                        <td><img src='pager/icons/next.png' class='next'/></td>
                                        <td><img src='pager/icons/last.png' class='last'/></td>
                                        <td>
                                                <select class='pagesize'>
                                                        <option selected='selected'  value='10'>10</option>
                                                        <option value='20'>20</option>
                                                        <option value='30'>30</option>
                                                        <option  value='40'>40</option>
                                                </select>
                                        </td>
                                </tr>
                                </table>
                        </form>
                </div>



<!--<p align="center">
<input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">
<input type=reset  value="Back"  class=buttonstyle onclick="javascript:window.location.href='admin.php';">
</p>-->   
</div>
</div>
</div>
<div class="container bottom">
</div>
<?php 
   include("../footer.php");
?>
</body>
</html>
 
