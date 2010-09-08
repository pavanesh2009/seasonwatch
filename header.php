<?php
	include_once("includes/dbc.php");
	include_once("functions.php");
?>
<script type="text/javascript">
$().ready(function() {
	$("#query").autocomplete("rpc.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});

	 $("#query").result(function(event, data, formatted) {
    $("#speciesid2").val(data[1]);
      });
   	});
</script>

<!--for emptyonclick-->
<script type="text/javascript" src="js/jquery.emptyonclick.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.emptyonclick').emptyonclick();
});
</script>
<script type="text/javascript">
function search_validate() {
if (document.search_form.speciesid2.value=="") {
	alert("Please select a species name and then press the Go button");
	return false;
}
return true;
}
</script>
<div class="container top">
     <div class="left">
     	  <div class="container logo-box">
    	      <div style='float:left'>
      	       	    <a href='index.php'><img style="margin-left:0" src="images/swlogo.jpg" alt="SeasonWatch" title="SeasonWatch"></a>
    	      </div>
	      <div style='float:right;margin-top:26px'>
      	      	   <form name="frm_login" action="login.php" method="POST">
		   <table>
	           <? if(  $_SESSION['user_id'] ) { ?>
             	   <tr>
			<td style='text-align:right;'><?php if (isset($_SESSION['school_name'])) echo $_SESSION['school_name']; else echo $_SESSION['user_name']; ?>&nbsp;( <?php if (isset($_SESSION['school_name'])) echo "<a href='school_profile.php'>"; else echo "<a href='mysettings.php'>"; ?>profile</a>&nbsp;/&nbsp;<a href='logout.php?cmd=logout'>sign out</a> )&nbsp;</td>
             	   </tr>
                  <? } else { ?>
	  	  <tr>
			<td class="small-link" style="margin:0;padding:0;font-size:10px;">
           		    <table style="margin:0;padding:0;width:390px;">
			    <tr>
           		    	   <td style="text-align:right;width:150px"><font color="black">sign up:</font> <a title="register"  href="register.php">individuals</a><font color="black">|</font><a title="register"  href="school_register.php">school groups</a></td>
           			   <td style="padding-left:35px">
				       <a title="forgot password ?" href="forgot.php">forgot?</a>
				   </td>
				   <td style="text-align:right;padding-right:33px">
                  		       <a  title="remember me" class="rememberme"  href="#">remember me</a> 
				       <a style="display:none" class="rememberme"  href="#">remembered</a>
                  		       <input type="hidden" value="0" id="remember" name="remember">
          			   </td>
	   		    </tr>
           		    </table>

         		</td>
		  </tr>
             	  <tr>
			<td style="padding:0;margin:0;">
		  	    <input class="default-value login-box" type="text" name="usr_email" value="email id" />
		  	    <input id="password-clear" class="login-box" type="text"  value="password" autocomplete="off"/>
		  	    <input class="login-box" id="password-password" type="password" name="pwd" value="" autocomplete="off" />
                  	    <input type="hidden" name="cmd" value="login" />
		  	    <input name="doLogin" style="width:30px;height:26px;border:solid 1px #666" type="submit" value="go" onclick="javascript:return validate();">
			</td>
	    	  </tr>
	     <? } ?>
      	     	  </table>
	          <? if(  $_SESSION['user_id'] ) { ?>				  
      		  <table class="main-links"> 
				<tr>
				<td style=""><?php if (isset($_SESSION['school_name'])) echo "<a href='school_contrib.php'>school&nbsp;home</a>"; else echo "<a href='contrib.php'>my&nbsp;home</a>";?></td>
				<td style=''>|</td>
				<td style=""><a href="addtree_options.php">add&nbsp;tree</a></td>
				<td style=''>|</td>
				<td style=""><a href="listtree.php">edit&nbsp;tree</a></td>
				<td style=''>|</td>
				<td style=""><a href="listtree_for_observation.php">add&nbsp;observation</a></td>
				<td style=''>|</td>
				<td style=""><a href="listobservations.php">edit&nbsp;observation</a></td>
				</tr>
				</table>
				<? } ?>
      		</form>
    	       </div>
  	  </div>
	  <div class="container main_banner">
    
	  </div>
	  <div class="container menu-links">
 	   <ul id="jsddm">
    <li><a href="#">join</a>
        <ul>
            <li><a href="content.php?page_id=57">why join</a></li>
			<li><a href="content.php?page_id=59">why monitor phenology</a></li>
        </ul>
    </li><li>|</li>
    <li><a href="#">what to do</a>
        <ul>
            <li><a href="content.php?page_id=30">how to participate</a></li> 
			<li><a href="content.php?page_id=34">download forms</a></li>
			<li><a href="content.php?page_id=36">how to monitor your trees</a></li>
			<li><a href="content.php?page_id=40">how to select your plants</a></li>
			<li><a href="content.php?page_id=42">register your tree</a></li>
        </ul><li>|</li>
    </li>
	<li><a href="#">participants</a>
        <ul>
            <li><a href="participants.php">individuals</a></li>
            <!--<li><a href="groups.php">groups</a></li>
            <li><a href="participant_map.php">participant map</a></li>-->
        </ul><li>|</li>
    </li>
 <!--<li><a href="#">species</a>
        <ul>
            <li><a href="migrants_we_watch.php">migrants we watch</a></li>
            <li><a href="guide.php">species guide</a></li>
            <li><a href="highlighted_species.php">highlighted species</a></li>
            <li><a href="all_species.php">all species</a></li>
        </ul><li>|</li>
    </li>
	<li><a href="#">campaigns</a>
        <ul>
            <li><a href="piedcuckoo.php">pied cuckoo</a></li>
            
        </ul><li>|</li>
    </li>
	<li><a href="#">data</a>
        <ul>
            <li><a href="data.php">view data/maps</a></li>
            <li><a href="terms_of_use.php">terms of use</a></li>
        </ul><li>|</li>
    </li>-->
	<li><a href="#">resources</a>
        <ul>
            <li><a href="content.php?page_id=46">phenology monitoring by citizens</a></li>
            <li><a href="content.php?page_id=12">citizen science projects</a></li>
			<li><a href="content.php?page_id=50">plant phenology and climate change</a></li>
			<li><a href="content.php?page_id=53">online tools for plant identification and regional names</a></li>
        </ul><li>|</li>
    </li>
	<!--<li><a href="#">news</a>
        <ul>
            <li><a href="media.php">media</a></li>       
        </ul><li>|</li>
    </li>
	<li><a href='blog'>blog</a></li><li>|</li>-->
	<li><a href='content.php?page_id=93'>faq</a></li><li>|</li>
	<li><a href='#'>about</a>
	  <ul>
			<li><a href="content.php?page_id=7">about us</a></li>
			<li><a href="content.php?page_id=55">seasonwatch team</a></li>
            <li><a href="content.php?page_id=9">acknowledgments</a></li>
			<li><a href="content.php?page_id=14">contact us</a></li>
			<li><a href="content.php?page_id=17">history of citizen science</a></li>
         </ul>
	</li>
</ul>

 <div style="float:right">
      <form name="search_form" action="species_guide.php" method="POST" onSubmit="javascript: return search_validate();">
	  <input type="hidden" name="speciesid2" id="speciesid2" value=""/>
      <input type="text" class="emptyonclick" class="ac_input" name="query" id="query" style="border:solid 1px #666;" value="type a species name" autocomplete="off" delay="1500">
      <input type="hidden" name="search" value="1"> 
      <input type="submit" class="submit" value="go">
      </form>
 </div>
</div>

