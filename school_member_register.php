<?php 
	session_start();
	if($_SESSION[group_role]!='coord') header("Location: school_contrib.php");
   $page_title="SeasonWatch";
   include_once './includes/dbc.php';


if($_POST['doRegister'] == 'Register') 
{ 
/******************* Filtering/Sanitizing Input *****************************
This code filters harmful script code and escapes data of all POST data
from the user submitted form.
*****************************************************************/
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
//	echo $data[$key]."x";
}
  
/************************ SERVER SIDE VALIDATION **************************************/
/********** This validation is useful if javascript is disabled in the browswer ***/

if(empty($data['full_name']) || strlen($data['full_name']) < 4)
{
$err = urlencode("ERROR: Invalid name. Please enter atleast 3 or more characters for your name");
//header("Location: register.php?msg=$err");
//exit();
}


// Validate User Name
//elseif (!isUserID($data['user_name'])) {
//$err = urlencode("ERROR: Invalid user name. It can contain alphabet, number and underscore.");
//header("Location: register.php?msg=$err");
//exit();
//}

// Validate Email
elseif($data['usr_email']){
if(!isEmail($data['usr_email'])) {
$err = urlencode("ERROR: Invalid email.");
$email_checked='true';
//header("Location: register.php?msg=$err");
//exit();
}
}

// Check User Passwords
elseif (!checkPwd($data['pwd'],$data['pwd2'])) {
$err = urlencode("ERROR: Invalid Password or mismatch. Enter 3 chars or more");
//header("Location: register.php?msg=$err");
//exit();
}
	

else
{

$usr_email = $data['usr_email'];
//$user_name = $data['user_name'];

/************ USER EMAIL CHECK ************************************
This code does a second check on the server side if the email already exists. It 
queries the database and if it has any existing email it throws user email already exists
*******************************************************************/
$total=0;
if($data['usr_email']){
$rs_duplicate = mysql_query("select count(*) as total from users where user_email='$usr_email'") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);
}
if ($total > 0)
{
$err = "ERROR: This email id has already been used to register. Please try again with a different email id.";
//header("Location: register.php?msg=$err");
//exit();
}
}
/***************************************************************************/
if($err=='')
{
$user_ip = $_SERVER['REMOTE_ADDR'];

// stores md5 of password
$md5pass = md5($data['pwd']);
// Automatically collects the hostname or domain  like example.com) 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// Generates activation code simple 4 digit number
//$activ_code = rand(1000,9999);
if($data['usr_email']){
$sql_insert = "INSERT into `users`
  			(`full_name`,`user_email`,`pwd`,`address`,
  			`address1`,`address2`,`city`,`district`,`zip`,`landline_stdcode`,
  			`landline_num`,`mobile`,`date`,`users_ip`,`state_id`,`user_category`,`group_id`,`group_role`
			)
		    VALUES
		    ('".addslashes($data[full_name])."','".addslashes($data[usr_email])."','$md5pass',
		    '','','','','','','','','',now(),'$user_ip','','school',".$_SESSION[group_id].",'member')
			";

mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
}
else {
$sql_insert = "INSERT into `users`
  			(`full_name`,`pwd`,`address`,
  			`address1`,`address2`,`city`,`district`,`zip`,`landline_stdcode`,
  			`landline_num`,`mobile`,`date`,`users_ip`,`state_id`,`user_category`,`group_id`,`group_role`
			)
		    VALUES
		    ('".addslashes($data[full_name])."','$md5pass',
		    '','','','','','','','','',now(),'$user_ip','','school',".$_SESSION[group_id].",'member')
			";

mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
}
$user_id = mysql_insert_id($link);  
$md5_id = md5($user_id);
mysql_query("update users set md5_id='$md5_id' where user_id='$user_id'");
//echo "<h3>Thank You</h3> We received your submission.";
if($data['usr_email']){
$message = 
"Dear $data[full_name],

Welcome to the SeasonWatch Citizen Science initiative.
The Coordinator of $_SESSION[school_name] has registered you with SeasonWatch as one of the members of the group.
Here are your login details...

Email: $usr_email (the email id also serves as the username to login) \n
Passwordd: $data[pwd] \n

Should you forget your password, please go to http://seasonwatch.in/ and click on 'forgot?' in the top right corner. A new password will be sent to your email address.

By registering with SeasonWatch, you are joining other volunteers from all across the country in tracking how the changing climate is affecting seasonal events. By monitoring the timing of flowering, fruiting and leafing of your chosen tree(s), your school can make a tremendous contribution!

As a Member you could do the following:
	Add Trees
	Add observations

Please do get in touch with us at sw@seasonwatch.in if you need help participating or have suggestions for improvements.

Thank you for your interest and participation!
The SeasonWatch Team

http://seasonwatch.in  |  sw@seasonwatch.in

_____________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****
";

	mail($usr_email, "Login Details", $message,
    "From: \"SeasonWatch Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());


/********************* SMTP EMAIL WITH PHPMAILER LIBRARY *********************
i have heard lots of complaints that users not able to receive email using mail() function
so i am using alternate SMTP emailing which is quite fast and reliable. Before you use this you should
create POP/SMTP email in your hosting account 

This script needs class.phpmailer.php and class.smtp.php files from PHPMailer library.
Download here: http://phpmailer.sourceforge.net
********************************************************************************/

/*
require("includes/class.phpmailer.php");

$mail = new PHPMailer();

$mail->IsSMTP();        
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $smtp_user;  // SMTP username
$mail->Password = $smtp_passwd; // SMTP password


$mail->From     = $smtp_from;
$mail->FromName = $smtp_from_name;
$mail->AddAddress($usr_email);

$mail->Subject  = $smtp_subject;
$mail->Body     = $message;
$mail->WordWrap = 50;

$mail->Send();
*/
}
  header("Location: school_contrib.php");  
  exit();
}	 
}
   include("main_includes.php"); 
?>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
<script type="text/javascript">
function toggle_email()
{
if(document.getElementById('email_field_label').style.display=='none')
{
	document.getElementById('email_field_label').style.display='block';
	document.getElementById('email_field').style.display='block';
}
else
{
	document.getElementById('email_field_label').style.display='none';
	document.getElementById('email_field').style.display='none';
	document.getElementById('usr_email3').value='';
}
}
</script>

</head>

<body>
<link type="text/css" href="css/register.css" rel="stylesheet"></link>

<style>
.error { color: red; font-weight:normal }
</style>

<?php 
include("header.php");
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

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="main" align="left">
<tr> 
<td colspan="3">&nbsp;</td>
</tr>
<tr> 
<td width="160" valign="top"><p>&nbsp;</p>
      <p>&nbsp; </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td> 

    <td width="732" valign="top"><p>
	
<? 
	 if (isset($_GET['done'])) {
	  echo "<h2>Thank you</h2> Your registration is now complete and you can <a href=\"login.php\">login here</a>";
	  exit();
	  }
	?>
	
	
	</p>
      <h3 class="titlehdr">School Member Registration Form</h3>
      <p>Please register a free account. Please note that fields marked <span class="required">*</span> 
        are required.</p>
	 <?	
      if ($err!='') {
	  $msg = mysql_real_escape_string($err);
	  echo "<div class=\"notice\">$msg</div>";
	  }
	  if (isset($_GET['done'])) {
	  echo "<div><h2>Thank you</h2> Your school's registration is now complete and you can <a href=\"login.php\">login here</a></div>";
	  exit();
	  }
	  ?> 
	  <br>
	  	
<form action="<?php $_SERVER['PHP_SELF']; ?>"  method="POST" name="regForm" id="regForm">
<table class="register" cellspacing="2" cellpadding="2">
<tbody>

<tr>
<td align="right" style="color: red; font-weight: bold;"> </td>
</tr>
<tr>
<td>Your School's Name<span class="required"><font color="#CC0000">*</font></span></td>
<td>
<input name="school_name" type="text" readonly id="school_name" value="<?php echo $_SESSION['school_name'];?>"  size="40" class="required"/>
</td>
</tr>
<tr>
<td>Your Full Name<span class="required"><font color="#CC0000">*</font></span></td>
<td>
<input name="full_name" type="text" id="full_name" value="<?php echo $_POST['full_name'];?>"  size="40" class="required"/>
</td>
</tr>

<!--<tr> 
<td>Username<span class="required"><font color="#CC0000">*</font></span></td>
<td><input name="user_name" type="text" id="user_name"  value="<?php echo $_POST['user_name'];?>" class="required username" minlength="5" > 
<input name="btnAvailable" type="button" id="btnAvailable" 
onclick='$("#checkid").html("Please wait..."); $.get("checkuser.php",{ cmd: "check", user: $("#user_name").val() } ,function(data){  $("#checkid").html(data); });'
value="Check Availability"> 
<span style="color:red; font: normal 12px verdana; " id="checkid" ></span> 
</td>
</tr>-->

<tr> 
<td>Send email invite?<br/>
<?php
if ($email_checked!='true'){ ?>
<div id="email_field_label" style="display:none;">
Email Address 
<div>
<? } 
else {?>
<div id="email_field_label" style="display:block;">
Email Address 
<div>
<? } ?>
</td>
<td>
<?php
if ($email_checked!='true'){ ?>
<input type="checkbox" onclick="toggle_email();" style="border:none; align:left"><br/>
<div id="email_field" style="display:none;">
<input name="usr_email" type="text" id="usr_email3"  value="<?php echo $_POST['usr_email'];?>" autocomplete="off"> 
<!-- <span class="example">* Please enter a Valid email</span> -->
</div>
<? } 
else {?>
<input type="checkbox" onclick="toggle_email();" style="border:none; align:left" checked><br/>
<div id="email_field" style="display:block;">
<input name="usr_email" type="text" id="usr_email3"  value="<?php echo $_POST['usr_email'];?>" autocomplete="off"> 
<!-- <span class="example">* Please enter a Valid email</span> -->
</div>
<? } ?>

</td>
</tr>

<tr> 
<td>Enter a Password<span class="required"><font color="#CC0000">*</font></span> 
</td>
<td><input name="pwd" type="password" autocomplete="off" class="required password" minlength="5" id="pwd"> 
<!-- <span class="example">* 5 chars minimum</span> -->
</td>
</tr>
<tr> 
<td>Reenter the Password<span class="required"><font color="#CC0000">*</font></span> 
</td>
<td><input name="pwd2"  id="pwd2" class="required password" type="password" minlength="5" equalto="#pwd"></td>
</tr> 

</tbody>
</table>
<p align="center">
<input name="doRegister" type="submit" id="doRegister" value="Register">
<input type=reset  value="Clear"  class=buttonstyle>
<input type=reset  value="Cancel"  class=buttonstyle onclick="javascript:window.location.href='index.php';">
</p>
</form>
<p align="right"><span style="font: normal 9px verdana">Seasonwatch Page <a href="http://www.ncbs.res.in/"> NCBS </a></span></p>
</td>
<td width="196" valign="top">&nbsp;</td>
</tr>
<tr> 
<td colspan="3">&nbsp;</td>
</tr>
</table>
</form>
</div>
</div>
</div> 
<div class="container bottom"> </div>
<?php mysql_close($link);?>
<?php 
   include("footer.php");
?>
</body>
</html>
