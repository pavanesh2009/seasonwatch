<?php 
include './includes/dbc.php';
page_protect();

$tree_id=($_POST['tree_id']);
$user_id=($_POST['assigned_user']);
$old_user_id=($_POST['old_user_id']);
//echo "tree ".$tree_id."new user ".$user_id."old user " .$old_user_id ;
if($_POST['doUpdate'] == 'Update') {

$sql2 = "UPDATE user_tree_table SET  
         `user_id`='$user_id'
          WHERE tree_id = '$tree_id' AND user_id='$old_user_id';";
//echo "sql2"; 
mysql_query($sql2,$link) or die("Insertion Failed:" .mysql_error()); 

}

   session_start();
   $page_title="SeasonWatch";
?>
<html>
<body>

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
</div>
<div class="container bottom">
</div>
<?php 
	mysql_close($link);	
	include("footer.php");
?>
</body>
</html>

<script type="text/javascript">
window.top.tb_remove();
</script>