<?php
include './includes/dbc.php';
$q = $_GET["nickname"];
if (!$q) return;

$sql = "SELECT tree_nickname FROM user_tree_table WHERE user_id = '$_SESSION[user_id]'";

$rsd = mysql_query($sql);
$ret_msg="false";
while($rs = mysql_fetch_array($rsd)) {
     if ($rs['tree_nickname']==$q) $ret_msg="true";
}	
echo $ret_msg;
?>
<?php mysql_close($link);?>