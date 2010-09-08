<?php 
/********************** SCHOOL_PROFILE.PHP**************************
This updates school coordinator user settings and password
************************************************************/
include './includes/dbc.php';

page_protect();

$rs_settings = mysql_query("SELECT * FROM users where user_id='$_SESSION[user_id]'");
if($_POST['doUpdate'] == 'Update')  
{

$rs_pwd = mysql_query("SELECT pwd FROM users where user_id='$_SESSION[user_id]'");
list($old) = mysql_fetch_row($rs_pwd);


//check for old password in md5 format
	if($old == md5($_POST['pwd_old']))
	{
	//$newmd5 = md5(mysql_real_escape_string($_POST['pwd_new']));
	//mysql_query("update users set pwd='$newmd5' where user_id='$_SESSION[user_id]'");
	// Check User Passwords
	//$newpwd=$_POST['pwd_new'];
	if (!checkPwd($_POST['pwd_new'],$_POST['pwd_new2'])) {
		$err = urlencode("ERROR: Invalid Password or mismatch. Enter 3 chars or more");
		header("Location: school_profile.php?msg=$err");
		exit();
	}
	else
	{
	
		$newmd5 = md5($_POST['pwd_new']);
		//echo "userid: ". $_SESSION[user_id] . "   new pwd: " . $_POST['pwd_new'] . "md5: " . $newmd5;
		$sql="UPDATE users SET pwd='" . $newmd5 . "' WHERE user_id='" . $_SESSION[user_id] . "'";
		//echo $sql;		$sql_result = mysql_query($sql);
		if ($sql_result) {
				header("Location: school_profile.php?msg=$sql+Your new password is updated");
				exit();
			}
		else {
			header("Location: school_profile.php?msg=error: " . mysql_error());
			exit();
		}
	}
	} else
	{
	 	header("Location: school_profile.php?msg=Your old password is invalid");
	}

}
//echo $data[state];


if($_POST['doSave'] == 'Save')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

mysql_query("UPDATE users SET
			`full_name` = '".addslashes($data[name])."',
			`user_name` ='".addslashes($data[user_name])."',
			`user_email`='".addslashes($data[user_email])."',
			`address` = '".addslashes($data[address])."',
			`address1`= '".addslashes($data[address1])."',
			`address2`= '".addslashes($data[address2])."',
			`city`='".addslashes($data[city])."', 
			`district`='".addslashes($data[district])."',
			`state_id`= '$data[state_id]',
			`landline_stdcode` = '".addslashes($data[landline_stdcode])."',
			`landline_num` = '".addslashes($data[landline_num])."',
			`mobile` = '".addslashes($data[mobile])."'
			 WHERE user_id='$_SESSION[user_id]'") or die(mysql_error());
mysql_query("UPDATE user_groups SET
			`group_name` = '".addslashes($data[school_name])."'
			 WHERE group_id='$_SESSION[group_id]'") or die(mysql_error());
$_SESSION['school_name']=	$data[school_name];
header("Location: school_profile.php?msg=Your updates have been saved");
 } 
?>
<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>
<script>
  $(document).ready(function(){
    $("#myform").validate();
	 $("#pform").validate();
  });
</script>

</head>

<body>

<?php include("header.php");
?>

<div class="container first_image" style="-moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;">
<div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'>school profile</a></li>
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
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main" align="left">      
<tr> 
<td colspan="3">&nbsp;</td>
</tr>
<tr> 
<td width="160" valign="top"></td>  

<td width="732" valign="top">

<p>
<?php
if (isset($_GET['msg'])) {
	  $msg = mysql_real_escape_string($_GET['msg']);
	  echo "<div class=\"notice\">$msg</div>";
	  }
?>

<?php 
while ($row_settings = mysql_fetch_array($rs_settings)) {?>

<table class="edittable" cellspacing="2" cellpadding="2">
<form action="school_profile.php" method="post" name="myform" id="myform">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
<tr> 
<td colspan="2"> School Name <br> <input name="school_name" type="text" id="school_name"  <? if ($_SESSION[group_role]!='coord') echo "readonly"; ?> value="<? echo $_SESSION['school_name']; ?>" size="30"> 
<span class="example"></span></td>
</tr>
<tr> 
<td colspan="2"> Your Name <br> <input name="name" type="text" id="name"  value="<? echo $row_settings['full_name']; ?>" size="30"> 
<span class="example"></span></td>
</tr>
<tr> 

<tr> 
<td colspan="2"> User Email <br> <input name="user_email" type="text" id="user_email"   value="<? echo $row_settings['user_email']; ?>" size="30"> 
</td>
</tr>
<tr>
<?php
if ($_SESSION[group_role]=='coord')
{
?>
<tr> 
<td colspan="2"> Address <br> <input name="address" type="text" id="address"  class="required" value="<? echo $row_settings['address']; ?>" size="30"> 
</td>
</tr>
<tr>


<tr> 
<td colspan="2"> Address1 <br> <input name="address1" type="text" id="address1"   value="<? echo $row_settings['address1']; ?>" size="30"> 
</td>
</tr>
<tr>


<tr> 
<td colspan="2"> Address2 <br> <input name="address2" type="text" id="address2"   value="<? echo $row_settings['address2']; ?>" size="30"> 
</td>
</tr>


<tr> 
<td colspan="2"> City <br> <input name="city" type="text" id="city" value="<? echo $row_settings['city']; ?>" size="30"> 
</td>
</tr>

<tr> 
<td colspan="2"> District <br> <input name="district" type="text" id="district"   value="<? echo $row_settings['district']; ?>" size="30"> 
</td>
</tr>



<tr> 
<td colspan="2"> State <br> <select name="state_id" type="text" id="state_id"> <?php 
$sql = mysql_query("SELECT * FROM seswatch_states ORDER BY state_id");
echo "<option value='' SELECTED>------Choose your State------</option>";
while ($data = mysql_fetch_array($sql))
{
if($data['state_id']==$row_settings['state_id'])
{
$data1 .= "<option  value='".$data['state_id']."' selected>".$data['state']."</option>";
}
else 
{
$data1 .= "<option  value='".$data['state_id']."'>".$data['state']."</option>";
}
}
echo $data1;
?>" size="30"> 
</td>
</tr>


<!-- <tr> 
<td colspan="2"> Phone <br> <input name="tel" type="text" id="tel"  value="<? echo $row_settings['tel']; ?>" size="30"> 
</td>
</tr> -->
<tr>
<td colspan="2">Landline phone<br/>
STD<input type="text" name="landline_stdcode"  value="<? echo $row_settings['landline_stdcode']; ?>"style="width: 50px;"/>
&nbsp;-&nbsp;<input type="text" name="landline_num"  value="<? echo $row_settings['landline_num']; ?>" style="width:108px;"/>
</td>
</tr>
<tr>
<td colspan="2">Mobile<br/>
<input type="text"  value="<? echo $row_settings['mobile']; ?>" name="mobile"/>
</td>
</tr>
<?php 
}
?>         
<tr> 
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<p align="left"> 
<input name="doSave" type="submit" id="doSave" value="Save">
</p>
</form>
<? } ?>
</table>
      
<table class="edittable" cellspacing="2" cellpadding="2">
      <h3 id="hdr">Change Password</h3>
      <p>If you want to change your password, please input your old and new password 
        to make changes.</p>
      <form name="pform" id="pform" method="post" action="">
        <table width="80%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms">
          <tr> 
            <td width="31%">Old Password</td>
            <td width="69%"><input name="pwd_old" type="password" class="required password"  id="pwd_old"></td>
          </tr>
          <tr> 
            <td>New Password</td>
            <td><input name="pwd_new" type="password" id="pwd_new" class="required password" minlength="5" ></td>
          </tr>
           <tr> 
            <td>Re-enter New Password</td>
            <td><input name="pwd_new2" type="password" id="pwd_new2" class="required password" minlength="5" equalto="#pwd_new" ></td>
          </tr>
        </table>
        <p align="center"> 
          <input name="doUpdate" type="submit" id="doUpdate" value="Update">
        </p>
        <p>&nbsp; </p>
      </form>
      <p>&nbsp; </p>
      <p>&nbsp;</p>
	   
      <p align="right">&nbsp; </p></td>
    <td width="196" valign="top">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
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
