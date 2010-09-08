<? 
   session_start();
   $page_title="SeasonWatch";
   include("main_includes.php");
   
?>
<!--<script type="text/javascript" src="http://maps.gstatic.com/intl/en_ALL/mapfiles/208a/maps2.api/main.js"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&sensor=true&key=ABQIAAAAj3UilF0JUxStHMEeZ6myXxRoA5S-3Z3wsvNu5GgYp0l_QSL5PRRjXmVlRmkaRo256GwWQtR1lEvVFQ"></script>
<!--<script type="text/javascript" src="http://maps.gstatic.com/intl/en_ALL/mapfiles/208a/maps2.api/main.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/cat_js/intl/en_ALL/mapfiles/208a/maps2.api/%7Bmod_drag,mod_ctrapi,mod_scrwh,mod_kbrd,mod_api_gc%7D.js"></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/intl/en_ALL/mapfiles/208a/maps2.api/mod_apiiw.js"/></script>
<script type="text/javascript" charset="UTF-8" src="http://maps.gstatic.com/intl/en_ALL/mapfiles/208a/maps2.api/mod_exdom.js"/></script>
<style type="text/css">
@media print{.gmnoprint{display:none}}@media screen{.gmnoscreen{display:none}}
</style>
<style>
.error { color: red; }
</style> -->

<!-- Magic script to make thickbox html that comes in through ajax work. meaning the click to get larger image isn't there
when the page loads as it comes in subsequently through getSpecies function call. this script makes thickbox work with this too! -->
<script type="text/javascript">
function tb_init(){
	$(document).click(function(e){
	e = e || window.event;
	var el = e.target || e.scrElement || null;
	if(el && el.parentNode && !el.className || !/thickbox/.test(el.className))
	el = el.parentNode;
	if(!el || !el.className || !/thickbox/.test(el.className))
	return;
	var t = el.title || el.name || null;
	var a = el.href || el.alt;
	var g = el.rel || false;
	tb_show(t,a,g);
	el.blur();
	return false;
	});
};
</script>

<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }

	<!-- script for accesing session info through AJAX -->
function getSpecies(speciesid) {
//alert('in getlocname');
	var req = getXMLHTTP();
if (req) {
   req.onreadystatechange = function() {
	if (req.readyState == 4) {
	// only if "OK"
	if (req.status == 200) {						
	document.getElementById('tree_gallery').innerHTML=req.responseText;						
	}
else {
	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
   	}
		}				
		}			
		req.open("GET", "getspecies.php?q="+speciesid, true);
		req.send(null);
}
}


</script>
		
<script type="text/javascript">
			google.load("jquery", '1.2.6');
			google.load("maps", "2.x");
</script>
		

<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
			var map = new GMap2(document.getElementById('map'));
    		var burnsvilleMN = new GLatLng(20.920397,78.222656);
	   	map.setCenter(burnsvilleMN, 3);
	   	//Added by Pavanesh The setCenter() method requires a GLatLng coordinate and a zoom level and 
	   	//this method must  be sent before any other operations are performed on the map, 
	   	//including setting any other attributes of the map itself. 
		
			var bounds = new GLatLngBounds();
		   var geo = new GClientGeocoder(); 
		   map.setUIToDefault();
		   // set default view settalite type added by Pavanesh
		 // map.setMapType(G_SATELLITE_MAP);
				
var reasons=[];
reasons[G_GEO_SUCCESS]            = "Success";
reasons[G_GEO_MISSING_ADDRESS]    = "Missing Address";
reasons[G_GEO_UNKNOWN_ADDRESS]    = "Unknown Address.";
reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Unavailable Address";
reasons[G_GEO_BAD_KEY]            = "Bad API Key";
reasons[G_GEO_TOO_MANY_QUERIES]   = "Too Many Queries";
reasons[G_GEO_SERVER_ERROR]       = "Server error";
				

// initial load points

	$.getJSON("map-service.php?action=listpoints", function(json) {
	if (json.Locations.length > 0) {
	for (i=0; i<json.Locations.length; i++) {
	var location = json.Locations[i];
	addLocation(location);
	}
zoomToBounds();
}
});
				
$("#add-point").submit(function(){
geoEncode();
return false;
});
				
function savePoint(geocode) {
var data = $("#add-point :input").serializeArray();
data[data.length] = { name: "lng", value: geocode[0] };
data[data.length] = { name: "lat", value: geocode[1] };
$.post($("#add-point").attr('action'), data, function(json){
$("#add-point .error").fadeOut();
if (json.status == "fail") {
$("#add-point .error").html(json.message).fadeIn();
}
if (json.status == "success") {
							$("#add-point :input[name!=action]").val("");
							var location = json.data;
							addLocation(location);
							zoomToBounds();
						}
					}, "json");
				}
				
function geoEncode() {
	var address = $("#add-point input[name=address]").val();
	geo.getLocations(address, function (result){
	if (result.Status.code == G_GEO_SUCCESS) {
	geocode = result.Placemark[0].Point.coordinates;
	savePoint(geocode);
	} else {
		var reason="Code "+result.Status.code;
	if (reasons[result.Status.code]) {
	reason = reasons[result.Status.code]
							} 
							$("#add-point .error").html(reason).fadeIn();
							geocode = false;
						}
					});
				}
				
				function addLocation(location) {
					var point = new GLatLng(location.lat, location.lng);		
					var marker = new GMarker(point);
					map.addOverlay(marker);
					bounds.extend(marker.getPoint());
					
$("<li />")
.html(location.name)
.click(function(){
showMessage(marker, location.name);
})
.appendTo("#list");
					
GEvent.addListener(marker, "click", function(){
showMessage(this, "Species name: "+location.species_name+"<br/>User: "+location.full_name);
//map.panTo(marker.getLatLng());              //onclick marker centralised map added by pavanesh
});
}
				
function zoomToBounds() {
	map.setCenter(bounds.getCenter());
    
    //for zoom india locations 	
	//map.setZoom(map.getBoundsZoomLevel(bounds)-1);
	map.setZoom(map.getBoundsZoomLevel(bounds));
	}
	
$("#message").appendTo( map.getPane(G_MAP_FLOAT_SHADOW_PANE) );
				
function showMessage(marker, text){
map.panTo(marker.getPoint()); //added by Pavanesh
var markerOffset = map.fromLatLngToDivPixel(marker.getPoint());
$("#message").hide().fadeIn('slow')
.css({ top:markerOffset.y, left:markerOffset.x })
.html(text);
}

});

</script>



<!-- Map-Toggle Script -->
<script type="text/javascript">
$(document).ready(function() {
$('#map').hide();
$('#list').hide();
var toggled = false;
$('#map-show-hide').click(function() {
$('#map').toggle();
<!--$('#list').toggle();-->

if( toggled==false ) { $('#map-show-hide').html("All&nbsp;Trees&nbsp;<span style='color:#d95c15'>(-)</span>"); toggled = true; } else {
$('#map-show-hide').html("All&nbsp;Trees&nbsp;<span style='color:#d95c15'>(+)</span>");
 toggled = false;
 }
});
 $('.error_top').corner();

 $('.first_image').corner('bottom');
 //$('#rememberme').toggle();

});
</script>


<style media="screen" type="text/css"> 
#map { float:left; width:700px; height:350px;margin:10;padding:0; border: solid 0.2px; }
#list { float:right; width:200px;height:350px; background:#fff;
 list-style:none; padding:0;margin:0;margin-right:8px; 
 background-image:url('images/boxshadow.gif'); 
 background-position:bottom left; 
 background-repeat:no-repeat;
 font-size:12px;
  }
#list li { padding:10px; }
#list li:hover { background:#555; color:#fff; cursor:pointer; cursor:hand; }
#message { background:#555; color:#fff; font-size:10px; position:absolute; display:none; width:100px; padding:5px; }
#add-point { float:left; }
div.input { padding:3px  0; }
label { display:block; font-size:13px; }
input, select { width:150px; }
button { float:right; }
div.error { color:red; font-weight:bold; }
</style>
</head>

<body onLoad="getSpecies('1000');">
<? 
	include("header.php");
?>
<div class='container first_image'>

<div class="map-show-link" style="margin-top: -4px;">
<a id="map-show-hide" href="#">
All Trees
<span style="color: rgb(217, 92, 30);">(+)</span>
</a>
<div id="map" style="margin-left: 8px; position: relative; background-color: rgb(229, 227, 223); display: block;">
</div>
</div>
<ul id="list" style="display: block;">
</ul>
<div id="message"></div>


<!-- <ul id="list" style=""> 
<li>Pine; Pine wood is hard and tough except white pine which is soft. It decays easily if it comes into contact with soil.</li>
<li>Oak, Oak is strong and durable, with straight silvery grain. It is used for preparing sporting goods..</li>
<li>Toon, Red Cedar It can be easily worked. It is light in weight. It is used for such products as furniture, packing boxes, cabinet making and door panels.</li>
<li>Tamarind Tamarind is knotty and durable. It is a beautiful tree for avenue and gardens. Its development is very slow but it ultimately forms a massive appearance</li>
<li>Sal It is hard, fibrous and close-grained. It does not take up a good polish. It requires slow and careful seasoning</li></ul>
 -->
 
<table style="width: 930px; margin-left: auto; margin-right: auto;">
<tbody>
<tr>
	<td colspan="1">
	<hr/>
	</td>
</tr>
<tr>
	<td>
	<table>
	<tr>
		<td class="cms" style="border-right: 1px solid rgb(217, 92, 21); width: 45%;">
		<h3>About SeasonWatch</h3>
		<?php 
		$count_all_trees = mysql_query("SELECT count(tree_id) FROM trees");
		$row_all_trees = mysql_fetch_array($count_all_trees);
		$count_all_species = mysql_query("SELECT count(DISTINCT species_master.species_id) FROM trees INNER JOIN species_master ON trees.species_id = species_master.species_id");
		$row_all_species = mysql_fetch_array($count_all_species);
		?>
		<?php
			 $page_id=21;
			 $page=mw_get_page($page_id);
		?>
			 <? echo nl2br($page[1]); ?>
			 <br/>At the moment, <b><?php echo $row_all_trees['count(tree_id)']; ?></b> trees of <b><?php echo $row_all_species['count(DISTINCT species_master.species_id)']; ?></b> different species are being monitored by volunteers. <a href="http://seasonwatch.in/beta/content.php?page_id=7">Read more: What is SeasonWatch all about?</a>
		</td>
		<td class="cms" style="width: 45%; padding-left: 15px;">
		<h3>Tree Gallery</h3>
		<p id="tree_gallery">
		</p>
		</td>
	</tr>
	</table>
	</td>
</tr>
<tr>
	<td colspan="1">
	<hr/>
	</td>
</tr>
<tr>
	<td>
	<table>
	<tr>
		<td class="cms" style="border-right: 1px solid rgb(217, 92, 21); ">
		<h3>Who can join?</h3>
		<p>
		<span style="">
		<?php
			 $page_id=28;
			 $page=mw_get_page($page_id);
		?>
			 <? echo nl2br($page[1]); ?>
		</td>
		<td class="cms"  style="border-right: 1px solid rgb(217, 92, 21);padding-left:15px; ">
		<h3>SeasonWatch for schools</h3>
		<p>
		<span class="ver12blkht">
		<?php
			 $page_id=26;
			 $page=mw_get_page($page_id);
		?>
			 <? echo nl2br($page[1]); ?>
		</span>
		</p>
		</td>
		<td style="padding-left:15px;">
		<h3>SeasonWatch updates</h3>
			<table>
			<tr>
				<td><? include("get_popular_species.php"); ?></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</tbody>
</table>


<!-- <script type="text/javascript">
$(document).ready(function() {
 $('#map').show();
 $('#list').show();
 $('#map-show-hide').click(function() {
 $('#map').toggle();
 $('#list').toggle();
 });
 $('.error_top').corner(); 
 $('.first_image').corner('bottom');
 //$('#rememberme').toggle();
});  
</script> -->

     
</div>
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