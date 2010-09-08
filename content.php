<? 
	session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
?>
<body><? 
	include("header.php");	
?>
<style> .cms { font-size:13px; line-height:1.8em; padding:20px;} 
.cms:first-letter { font-size:xx-large; font-weight:bold } 
</style>
<div class="container first_image">
<?php
	 $page_id=$_GET['page_id'];
	 $page=mw_get_page($page_id);

?>
   <div id='tab-set'>   
     <ul class='tabs'>
        <li><a href='#x' class='selected'><? echo $page[0]; ?></a></li>
    </ul>
   </div>
   <div class='page_layout cms'>
     <? echo nl2br($page[1]); ?>
   </div>
</div>
</div>
</div>
<div class="container bottom">

</div>
<?php 
   include("footer.php");
?>
</body>
</html>
