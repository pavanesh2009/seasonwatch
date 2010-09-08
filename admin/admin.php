<?php 
   session_start();
   $page_title="::: SeasonWatch :::";
   //include("../main_includes.php");
   include("../includes/dbc.php");

if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}
$page_limit = 15; 
if (!isset($_GET['page']) )
{ $start=0; } else
{ $start = ($_GET['page'] - 1) * $page_limit; }
$rs_all = mysql_query("select count(*) as total_all from users") or die(mysql_error());
$rs_active = mysql_query("select count(*) as total_active from users where approved='1'") or die(mysql_error());
$rs_pending = mysql_query("select * from users where approved='0' limit $start,$page_limit") or die(mysql_error());
$rs_total_pending = mysql_query("select count(*) as tot from users where approved='0'");						   
list($total_pending) = mysql_fetch_row($rs_total_pending);
$rs_recent = mysql_query("select * from users where approved='1' order by date desc limit 25") or die(mysql_error());
list($all) = mysql_fetch_row($rs_all);
list($active) = mysql_fetch_row($rs_active);
$nos_pending = mysql_num_rows($rs_pending);
?>


<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<?php
include("../main_includes.php");
?>
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
<td><b><h3>Welcome to Admin Panel</h3></b></td>
</tr>
</table>
<div>
<hr>
</div>

<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
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

<table>
<tr>
<td>
<b>All Registered Users</b>
</td>
</tr>
</table>
<div>
<hr/>
</div>


<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tr> 
<td>Total users: <?php echo $all;?></td>
<td>Active users: <?php echo $active; ?></td>
<td>Pending users: <?php echo $nos_pending; ?></td> 
</tr>
</table>
     <!-- <p>&nbsp;</p>  
 <table width="80%" border="0" align="center"  cellpadding="10" cellspacing="5" bgcolor="#e5ecf9">
        <tr> 
          <td><form name="form1" method="post" action="admin_results.php">
              Search    
              <input name="q" type="text" id="q">
              <input type="submit" name="Submit" value="Submit">
              [Type email or name] </form></td>
        </tr> 
      </table> 
      <p><strong>*Note: </strong>Once the user is banner, he/she will never be 
        able to register new account with same email address.</p>
      <h3>Users Pending Approval</h3>   
      <p>Approve -&gt; A notification email will be sent to user notifying activation.<br>
        Ban -&gt; No notification email will be sent to the user.</p>
      <p>Total Pending: <? echo $total_pending; ?></p> --> 


<div>      
<table id="table1" class="tablesorter">
                <thead>
                        <tr>
                                <th style='width:120px'>User ID</th>
                                <th style='width:200px'>Join Date</th>           
                                <th style='width:150px'>User Name</th>
                                <th style='width:100px'>Email</th>                        
				<th style='width:200px'>Location</th>
<!--<th style='width:150px'>Approvel</th>
<th style='width:150px'>Banned</th>
<th style='width:150px'>Approved</th>
<th style='width:150px'>Banned</th>
<th style='width:150px'>Unbanned</th>                    -->
                </tr>
                </thead>
<tbody>    

     
<?php  
while ($prows = mysql_fetch_array($rs_pending)) {?>
<tr> 
          <td>#<? echo $prows['user_id']?></td>
          <td><? echo $prows['date']?></td>
          <td><? echo $prows['full_name']?></td>
          <td><? echo $prows['user_email']?></td>
<td>
<?php
$query=mysql_query("SELECT state FROM seswatch_states WHERE state_id='$prows[state_id]'");
while($query1 = mysql_fetch_array($query))
{
echo $query1['state'];
}
?>
</td>

     
<!--<td> <span id="papprove<? echo $prows['user_id']; ?>">
         <? if(!$prows['approved']) { echo "Pending"; } else {echo "yes"; }?>
</span>
</td>
          <td><span id="pban<? echo $prows['user_id']; ?>">
            <? if(!$prows['banned']) { echo "no"; } else {echo "yes"; }?>
</span> 
</td>

<td> 
<a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "approve", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#papprove<? echo $prows['user_id']; ?>").html(data); });'>Approve</a> 
</td>
<td>
<a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "ban", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#pban<? echo $prows['user_id']; ?>").html(data); });'>Ban</a> 
</td>
<td>
<a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "unban", user_id: "<? echo $prows['user_id']; ?>" } ,function(data){ $("#pban<? echo $prows['user_id']; ?>").html(data); });'>Unban</a>
</td>-->
</tr>
<? } ?>
</tbody>
</table>

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
</div>
</div>
<!--<p>
<?php
// generate paging here
if ($total_pending > $page_limit)
{
$total_pages = ceil($total_pending/$page_limit);
echo "<h4><font color=\"#CC0000\">Pages: </font>";
$i = 0;
while ($i < $total_pages) 
{
$page_no = $i+1;
echo "<a href=\"admin.php?page=$page_no\">$page_no</a> ";
$i++;
}
echo "</h4>";
}?>
</p>

<p>
<input name="doRefresh" type="button" id="doRefresh" value="Refresh All" onClick="location.reload();">
</p>-->
    
<!--    
    
      <h3>Recent Registrations</h3>
      <p>This shows to <strong>25 latest approved</strong> registrations and their 
        banned status.</p>
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#e5ecf9">  
          <td width="4%"><strong>ID</strong></td>
          <td> <strong>Date</strong></td>
          <td><strong>User Name</strong></td>
          <td width="29%"><strong>Email</strong></td>
          <td width="10%"><strong>Approved</strong></td>
          <td width="8%"> <strong>Banned</strong></td>
          <td width="19%">&nbsp;</td>
        </tr>
        <tr>  
          <td>&nbsp;</td>
          <td width="12%">&nbsp;</td>
          <td width="18%">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <? while ($rrows = mysql_fetch_array($rs_recent)) {?>
    <tr> 
          <td>#<? echo $rrows['user_id']?></td> 
          <td><? echo $rrows['date']?></td> 
          <td><? echo $rrows['user_name']?></td> 
          <td><? echo $rrows['user_email']?></td>
          <td> <span id="approve<? echo $rrows['user_id']; ?>">
            <? if(!$rrows['approved']) { echo "Pending"; } else {echo "yes"; }?>
			</span>
          </td> 
          <td><span id="ban<? echo $rrows['user_id']; ?>">
            <? if(!$rrows['banned']) { echo "no"; } else {echo "yes"; }?>
			</span> 
          </td>
          <td> 
		    <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "approve", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#approve<? echo $rrows['user_id']; ?>").html(data); });'>Approve</a> 
           | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "ban", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#ban<? echo $rrows['user_id']; ?>").html(data); });'>Ban</a> 
		   | <a href="javascript:void(0);" onclick='$.get("do.php",{ cmd: "unban", user_id: "<? echo $rrows['user_id']; ?>" } ,function(data){ $("#ban<? echo $rrows['user_id']; ?>").html(data); });'>Unban</a>
			</td>
        </tr>
        <? } ?> 
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>  
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>  
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table> -->
</div>      
</div>
</div>
<div class="container bottom">
<?php mysql_close($link);?>
</div>
<?php 
   include("../footer.php");
?>
</body>
</html>
