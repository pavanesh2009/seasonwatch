<?php 
include './includes/dbc.php';



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

elseif(empty($data['school_name']) || strlen($data['school_name']) < 4)
{
$err = urlencode("ERROR: Invalid school name. Please enter atleast 3 or more characters for the school name");
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
elseif(!isEmail($data['usr_email'])) {
$err = urlencode("ERROR: Invalid email.");
//header("Location: register.php?msg=$err");
//exit();
}

// Check User Passwords
elseif (!checkPwd($data['pwd'],$data['pwd2'])) {
$err = urlencode("ERROR: Invalid Password or mismatch. Enter 3 chars or more");
//header("Location: register.php?msg=$err");
//exit();
}
	

// Check User City/Town/Village Information 
elseif (empty($data['city']))
{
$err = urlencode("ERROR: Please Enter your City name");
//header("Location: register.php?msg=$err");
//exit();
}



// Check User District Information 
//elseif (empty($data['dist'])) {
//$err = urlencode("ERROR: Please Enter your District name");
//header("Location: register.php?msg=$err");
//exit();
//}


// Check User State Information 
elseif (empty($data['state'])) {
$err = urlencode("ERROR: Please Choose your State");
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

$rs_duplicate = mysql_query("select count(*) as total from users where user_email='$usr_email'") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

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

$sql_insert = "INSERT into `users`
  			(`full_name`,`user_email`,`pwd`,`address`,
  			`address1`,`address2`,`city`,`district`,`zip`,`landline_stdcode`,
  			`landline_num`,`mobile`,`date`,`users_ip`,`state_id`,`user_category`,`group_id`,`group_role`
			)
		    VALUES
		    ('".addslashes($data[full_name])."','".addslashes($usr_email)."','$md5pass',
		    '".addslashes($data[address])."','".addslashes($data[address1])."','".addslashes($data[address2])."',
		    '".addslashes($data[city])."','".addslashes($data[dist])."','".addslashes($data[zip])."','".addslashes($data[landline_stdcode])."','".addslashes($data[landline_num])."',
		    '".addslashes($data[mobile])."',now(),'$user_ip','$data[state]','school','','coord')
			";

mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
$user_id = mysql_insert_id($link);  
$md5_id = md5($user_id);
mysql_query("update users set md5_id='$md5_id' where user_id='$user_id'");
mysql_query("INSERT INTO `user_groups` (`coord_id`,`group_name`) VALUES ('$user_id','$school_name');",$link) or die("Insertion Failed:" . mysql_error());
$group_id = mysql_insert_id($link);  
mysql_query("update users set group_id='$group_id' where user_id='$user_id'");
//echo "<h3>Thank You</h3> We received your submission.";

$message = 
"Dear $data[full_name],

Thank you for registering $data[school_name] with SeasonWatch. You are the Coordinator for your school on the website.
Here are your login details...

Email: $usr_email (the email id also serves as the username to login) \n
Passwordd: $data[pwd] \n

Should you forget your password, please go to http://seasonwatch.in/ and click on 'forgot?' in the top right corner. A new password will be sent to your email address.

By registering with SeasonWatch, your school is joining other schools and volunteers from all across the country in tracking how the changing climate is affecting seasonal events. By monitoring the timing of flowering, fruiting and leafing of your chosen tree(s), your school can make a tremendous contribution!

Now as the Coordinator you could do the following by logging in:
	Add other members to your school group
	Add trees on behalf of the members
	Add observations on trees

Members you add to your group could themselves do the following:
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

  header("Location: thankyou.php");  
  exit();
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
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
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
      <h3 class="titlehdr">School Registration Form</h3>
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
<input name="school_name" type="text" id="school_name" value="<?php echo $_POST['school_name'];?>"  size="40" class="required"/>
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
<td>Email Address<span class="required"><font color="#CC0000">*</font></span> 
</td>
<td><input name="usr_email" type="text" id="usr_email3"  value="<?php echo $_POST['usr_email'];?>" class="required email" autocomplete="off"> 
<!-- <span class="example">* Please enter a Valid email</span> -->
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
<tr>
<td align="right">Mailing Address </td>
<td>
<input type="text" name="address"  value="<?php echo $_POST['address'];?>" id="address"/>
</td>
</tr>
<tr>
<td align="right">Address (line 2) (optional)</td>
<td>
<input type="text" name="address1" value="<?php echo $_POST['address1'];?>" />
</td>
</tr>
<tr>
<td align="right">Address (line 3) (optional)</td>
<td>
<input type="text" name="address2" value="<?php echo $_POST['address2'];?>" />
</td>
</tr>
<tr>
<td align="right">City/Town/Village<font color="#CC0000">*</font></td>
<td>
<input type="text" id="city" name="city"  value="<?php echo $_POST['city'];?>" class="required"/>
</td>
</tr>
<tr>
<td align="right">District</td>
<td>
<input type="text" id="dist" name="dist"  value="<?php echo $_POST['dist'];?>"/>
</td>
</tr>
<tr>
<td>State or Union Territory<font color="#CC0000">*</font> </td>
<td>
<select id="state" name="state" class="required" ><?php
$result= mysql_query("SELECT * FROM seswatch_states ORDER BY state_id");
echo "<option value='' SELECTED>------Choose your State------</option>";
while($nt=mysql_fetch_array($result))
{
echo "<option value=$nt[state_id]>$nt[state]</option>";
} 
echo "</select>";
?>
</td>
</tr>

<tr>
<td>Country</td>
<td>
<input class="" type="text" value="India" name="country"  value="<?php echo $_POST['country'];?>" />
</td>
</tr>

<tr>
<td align="right">Post code (PIN code)</td>
<td>
<input type="text" name="zip" value="<?php echo $_POST['zip'];?>" />
</td>
</tr>


<tr>
<td align="right">Landline phone</td>
<td align="left">
STD<input type="text" name="landline_stdcode" style="width: 50px;"/>
&nbsp;-&nbsp;<input type="text" name="landline_num"  value="<?php echo $_POST['landline_num'];?>" style="width:108px;"/>
</td>
</tr>

<tr>
<td align="right">Mobile</td>
<td>
<input type="text" name="mobile" value="<?php echo $_POST['mobile'];?>" />
</td>
</tr>

</tbody>
</table>
<p align="center">
<input name="doRegister" type="submit" id="doRegister" value="Register">
<input type=reset  value="Clear"  class=buttonstyle>
<input type=reset  value="Cancel"  class=buttonstyle onclick="javascript:window.location.href='index.php';">
</p>
</form>
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
