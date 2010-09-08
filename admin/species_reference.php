<? 
   session_start();
   $page_title="::: SeasonWatch :::";
   include("../main_includes.php");
   include("../includes/dbc.php");
?>
 
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
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

<div>      
<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:80px'>Species ID</th>           
                                <th style='width:150px'>Species Primary Name</th>
                                <th style='width:150px'>Species Scientific Name</th>                        
				<th style='width:150px'>Family</th>
           </tr>

</thead>
<tbody>
<?php 
$result = mysql_query("SELECT species_id,species_primary_common_name,species_scientific_name,family FROM species_master");
while ($row_settings = mysql_fetch_array($result)) 
{
print "<tr>";
//print $row_settings['species_id'];
print "<td>".$row_settings['species_id']."</td>";
print "<td>".$row_settings['species_primary_common_name']."</td>";
print "<td>".$row_settings['species_scientific_name']. "</td>";
print "<td style='width:220px'>".$row_settings['family']."</td>";
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


</div>
<div class="container bottom">
</div>
<?php 
   include("../footer.php");
?>
</body>
</html>


