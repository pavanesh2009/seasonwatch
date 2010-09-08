<?php
    session_start();
   $page_title=":: User Login Page ::";
  // include("../main_includes.php");
   include_once("../includes/dbc.php");
//echo $collectid;


if(!isset($_SESSION['user_admin'])) {
header("Location: index.php");
exit();
}

if ($_POST['doLogin']=='go')
{
$collectid2 = $_POST['userid'];

$sql = "SELECT `user_id`,`full_name` FROM users WHERE 
           user_id='$collectid2'"; 
$result = mysql_query($sql) or die (mysql_error()); 
$num = mysql_num_rows($result);
  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 && $_POST['pwd'] == 'admin') { 
	
	list($user_id,$full_name) = mysql_fetch_row($result);
	
	//if(!$approved) {
	//$msg = "Account not activated. Please check your email for activation code";
	//header("Location: login.php?msg=$msg");
	// exit();
	// }
 
     // this sets session and logs user in  
       
	   session_start(); 
	   // this sets variables in the session 
		$_SESSION['user_id']= $user_id;  
		$_SESSION['user_name'] = $full_name;
		
		//set a cookie witout expiry until 60 days
		
	 
		header("Location: ../contrib.php");
		}
		else
		{
		$msg = urlencode("Invalid Login");
		header("Location: inspectlogin.php?msg=$msg");
		}
		
}
else{
$collectid="$_GET[userid]";
$sql = "SELECT `user_email` FROM users WHERE 
           user_id= '$collectid'
			"; 

			
$result = mysql_query($sql) or die (mysql_error()); 
}
?>
<html>
<head>
<title>Seasonwatch Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--<script language="JavaScript" type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/jquery.validate.js"></script>-->
<?php
include("../main_includes.php");
?>
<script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
  </script>
</head>

<body>
<div class='container-top'>
<div class='container first_image'>
<table>
<tbody>
<tr>
<td><b><h3>All added Users</h3></b></td>
<td>
</td></tr>
</tbody>
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
<b>All Registered Users</b>
</tr>
</tbody>
</table>
<div>
<hr/>
</div>
<table style="width: 930px; margin-left: auto; margin-right: auto;">

<!--
<tr> 
<td colspan="3">&nbsp;</td>
</tr>
-->
<tr> 
<td width="160" valign="top"><p>&nbsp;</p>
<p>&nbsp; </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p></td>
<td width="732" valign="top"><p>&nbsp;</p>
<h3 class="titlehdr" align='left'>Login 
</h3>  
<p>

<?php 

/******************** ERROR MESSAGES*************************************************
This code is to show error messages 
**************************************************************************/
      if (isset($_GET['msg'])) {
	  $msg = mysql_real_escape_string($_GET['msg']);
	  echo "<div class=\"notice\">$msg</div>";
	  }
	  /******************************* END ********************************/	  
	  ?></p>
      <form action="inspectlogin.php" method="post" name="logForm" id="logForm" >
      <input type="hidden" name="userid" value="<? echo $collectid; ?>" />
        <table width="65%" border="0" cellpadding="4" cellspacing="4" class="loginform">
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="28%">Email</td>
            <td width="72%"><input name="usr_email" type="text" class="required" id="txtbox" size="25" value="<?php $user_email_id = mysql_fetch_array($result); echo $user_email_id['user_email']; ?>"></td>
          </tr>
          <tr> 
            <td>Password</td>
            <td><input name="pwd" type="password" class="required password" id="txtbox" size="25"></td>
          </tr>
          <tr> 
            </tr>
          <tr> 
            <td colspan="2"> <div align="center"> 
                <p> 
                  <input name="doLogin" type="submit" id="doLogin3" value="go">
                </p>
                
              </div></td>
          </tr>
        </table>
        <div align="center"></div>
        <p align="center">&nbsp; </p>
      </form>
      <p>&nbsp;</p>
	   
      </td>
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
</body>
</html>
