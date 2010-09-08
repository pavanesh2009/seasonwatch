<?php 
	include("includes/dbc.php");
if ($_POST['doLogin']=='go')
{
$user_email = mysql_real_escape_string($_POST['usr_email']);
$md5pass = md5(mysql_real_escape_string($_POST['pwd']));


if (strpos($user_email,'@') === false) {
    $user_cond = "user_email='$user_email'";
} else {
      $user_cond = "user_email='$user_email'";
    
}


$sql = "SELECT `user_id`,`full_name`,`user_category`,`group_id`,`group_role`  FROM users WHERE 
           $user_cond
			AND `pwd` = '$md5pass'
			"; 

			
$result = mysql_query($sql) or die (mysql_error()); 
$num = mysql_num_rows($result);
  // Match row found with more than 1 results  - the user is authenticated. 
    if ( $num > 0 ) { 
	
	list($user_id,$full_name,$user_category,$group_id,$group_role) = mysql_fetch_row($result);
	
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
		
	   if(isset($_POST['remember'])){
				  setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*60, "/");
				  setcookie("user_name", $_SESSION['user_name'], time()+60*60*24*60, "/");
				   }
		
		if ($user_category=='individual')
				header("Location: contrib.php");
		elseif ($user_category=='school')
		{
			$sql = "SELECT `group_name`  FROM user_groups WHERE 
					`group_id` = '$group_id'
					"; 
			$result2 = mysql_query($sql) or die (mysql_error()); 
			list($group_name) = mysql_fetch_row($result2);
			$_SESSION['school_name'] = $group_name;
			$_SESSION['group_id'] = $group_id;
			$_SESSION['group_role'] = $group_role;
			header("Location: school_contrib.php");
		}
		}
		else
		{
		$msg = urlencode("		Invalid Login");
		header("Location: login.php?msg=$msg");
		}
		
}
					 
					 

?>
<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>
  <script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
  </script>

<body>

<?php include 'header.php';
?>
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
      <form action="login.php" method="post" name="logForm" id="logForm" >
        <table width="65%" border="0" cellpadding="4" cellspacing="4" class="loginform">
          <tr> 
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="28%">Email</td>
            <td width="72%"><input name="usr_email" type="text" class="required" id="txtbox" size="25"></td>
          </tr>
          <tr> 
            <td>Password</td>
            <td><input name="pwd" type="password" class="required password" id="txtbox" size="25"></td>
          </tr>
          <tr> 
            <td colspan="2"><div align="center">
                <input name="remember" type="checkbox" id="remember" value="1">
                Remember me</div></td>
          </tr>
          <tr> 
            <td colspan="2"> <div align="center"> 
                <p> 
                  <input name="doLogin" type="submit" id="doLogin3" value="go">
                </p>
                <p> <a href="register.php">Register Free</a>
                  |</font> <a href="forgot.php">Forgot Password</a>
                 <!-- |</font> <a href="activate.php">Activate Account</a></p>  -->
                <p><span style="font color="#008000"">All Right Reserved 2009-2010 <a href="http://www.ncbs.res.in/">NCBS
                  National Centre for Biological Sciences</a> </span></p> 
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
<?php 
   include("footer.php");
?>
</body>
</html>
