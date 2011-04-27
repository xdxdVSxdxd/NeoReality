<?php
require_once"wordpress/wp-config.php";

global $wpdb;

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title>ARt Basel, a new world through art</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
jQuery.noConflict();
</script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="markerclusterer.js"></script>

<script type="text/javascript">



jQuery(document).ready(function(){
   // Your code here
});



function openPost(postid){



	jQuery.fancybox(
		{
        	'autoDimensions'	: false,
			'width'         		: 600,
			'height'        		: 500,
			'transitionIn'		: 'elastic',
			'type'				: 'iframe',
			'transitionOut'		: 'fade',
			'href'				: 'http://www.art-basel.org/neoreality/showPost.php?id=' + postid,
			'scrolling'			: 'auto'
		}
	);



}


var initialLocation;
var berlin;
var browserSupportFlag =  new Boolean();

var map;
var bounds = null;

var markersarray;
var markercluster;

function initialize() {


var styles =

[ { featureType: "water", elementType: "labels", stylers: [ { visibility: "off" } ] },{ featureType: "water", elementType: "geometry", stylers: [ { saturation: -99 }, { lightness: -100 } ] },{ featureType: "landscape.man_made", elementType: "all", stylers: [ { lightness: -72 }, { saturation: -100 } ] },{ featureType: "poi", elementType: "all", stylers: [ { visibility: "off" } ] },{ featureType: "transit", elementType: "all", stylers: [ { visibility: "off" } ] },{ featureType: "administrative", elementType: "labels", stylers: [ { lightness: -83 } ] },{ featureType: "administrative.country", elementType: "geometry", stylers: [ { visibility: "off" },{ lightness: -89 } ] },{ featureType: "road", elementType: "all", stylers: [ { saturation: -100 }, { lightness: -66 } ] },{ featureType: "landscape.natural", elementType: "all", stylers: [ { saturation: -96 }, { lightness: -87 } ] } ]
;


var customMapType = new google.maps.StyledMapType(styles, {name: "custom"});





	berlin  = new google.maps.LatLng(0, 0);
	
				//berlin  = new google.maps.LatLng(52.51867, 13.36474);
				
	
  var myOptions = {
    zoom: 2,
    center: berlin,
	mapTypeControl: false,
    mapTypeId: "custom" //google.maps.MapTypeId.HYBRID
  }
  map = new google.maps.Map(document.getElementById("cos-general-map"), myOptions);
  map.mapTypes.set('custom', customMapType);
  
  	
	
bounds = new google.maps.LatLngBounds();
  
  
  /*
    
  // Try W3C Geolocation (Preferred)
  if(navigator.geolocation) {
    browserSupportFlag = true;
    navigator.geolocation.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      map.setCenter(initialLocation);
    }, function() {
      handleNoGeolocation(browserSupportFlag);
    });
  // Try Google Gears Geolocation
  } else if (google.gears) {
    browserSupportFlag = true;
    var geo = google.gears.factory.create('beta.geolocation');
    geo.getCurrentPosition(function(position) {
      initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
      map.setCenter(initialLocation);
    }, function() {
      handleNoGeoLocation(browserSupportFlag);
    });
  // Browser doesn't support Geolocation
  } else {
    browserSupportFlag = false;
    //handleNoGeolocation(browserSupportFlag);
  }
  */

    
  
  
  
  
  
}
  


</script>
<style>
html,body{
margin:0px;
padding:0px;
width:100%;
height:100%;
background:#FFFFFF;
}
div#contentuto,div#cos-general-map{
margin:0px;
padding:0px;
width:100%;
height:100%;
background:#FFFFFF;
position: relative;
z-index: 100;
}

div#menu{
position:absolute;
top: 0px;
right: 0px;
z-index: 200;
float: right;
width: 200px;
padding: 0px;
margin: 0px;
color: #AAAAAA;
font: 10px Arial, Helvetica, sans-serif;
}
div#logo{
position: relative;
margin: 0px;
padding: 0px;
float: right;
width: 200px;
height: 200px;
margin-bottom: 12px;
}
div.controls{
position: relative;
margin: 0px;
padding: 0px;
padding-top: 12px;
float: right;
width: 200px;
margin-bottom: 12px;
margin-top: 6px;
}

a.clink, a.clink:visited{
display: block;
text-decoration: none;
background: transparent;
color: #FFFFFF;
position: relative;
margin: 0px;
padding: 0px;
float: right;
width: 120px;
}

a.clink:hover{
display: block;
text-decoration: none;
background: #E1001A;
position: relative;
margin: 0px;
padding: 0px;
float: right;
width: 120px;
}

div.c{
position: relative;
margin: 0px;
padding: 4px;
float: right;
width: 112px;
text-align:right;
}


span.label{
display:block;
float: left;
padding: 0px;
margin: 0px;
margin-right: 6px;
line-height: 14px;
width: 80px;
text-align:right;
}

span.image{
display:block;
float: left;
padding: 0px;
margin: 0px;
width: 26px;
text-align:center;
}

div#categoryname{
position:absolute;
width: 80px;
float: left;
z-index: 200;
top: 0px;
left: 300px;
background: #662222;
color: #AAAAAA;
font: 10px Arial, Helvetica, sans-serif;
line-height: 16px;
padding: 4px;
margin: 0px;
}

</style>
</head>
<body>
<div id="contentuto">
<?php
//echo do_shortcode("[cos-general-map]" );


$s = "";


$s = $s . "<div id='cos-general-map'> </div>";
	$s = $s . "<script type='text/javascript'>";
	$s = $s . "initialize();";
	$s = $s . "var coords;";
	$s = $s . "var poly;";





	$s = $s . "function createPolys(){";
	
	
	$args;
	
	if(isset($_GET["cat"]) ){
	
		$args = array(
    	'numberposts'     => -1,
		'category'		=> $_GET["cat"],
   	 	'orderby'         => 'post_date',
    	'order'           => 'DESC' );
		
	} else {
	
		$args = array(
    	'numberposts'     => -1,
   	 	'orderby'         => 'post_date',
    	'order'           => 'DESC' );
	
	}
		
	$pp = get_posts($args);
	
	$imk = 0;
	
	$s = $s . "markersarray = [];\n";
	
	
	
	foreach($pp as $p){
	
	
		$post_categories = wp_get_post_categories( $p->ID);



		$cid = 0;
		if(isset($post_categories) && count($post_categories)>0 ){
			$cid = $post_categories[0];
		}
		
		
		$icon = "http://google-maps-icons.googlecode.com/files/text.png";
		
		
	
		$icons = $wpdb->get_results("SELECT small_icon FROM wp_reffreffreff_ig_caticons WHERE cat_id = $cid ");
	
	
		
		if($icons && count($icons)>0){
		
			$icon = get_bloginfo("url") .  "/" .  $icons[0]->small_icon;
		}
		
		
		
	
		$lat = get_post_meta($p->ID, "_geotag_lat",true);
		$lng = get_post_meta($p->ID, "_geotag_lon",true);
		$tit = str_replace("'", " ", $p->post_title);
		
		
		
		$s = $s . "var ll$imk = new google.maps.LatLng($lat,$lng);\n";
		$s = $s . "var mk$imk = new google.maps.Marker( {";
		$s = $s . "	position: ll$imk,";
		//$s = $s . "	map: map,";
		$s = $s . "	title: '$tit', icon: '$icon' ";
		$s = $s . "});\n\n";
		$s = $s . "markersarray.push( mk$imk );\n\n";
		
		/*
		$s = $s . "var cs$imk=new google.maps.InfoWindow({";
		$s = $s . "content : \"" . str_replace('"', " ", $p->post_content) . "\"";
		$s = $s . "});\n";
		*/

		$s = $s . "google.maps.event.addListener(mk$imk, 'click', function() {  openPost(" . $p->ID . "); });\n";
		

	
		$imk++;
		
	
	}



		$s = $s . "markercluster = new MarkerClusterer(map, markersarray);";

		$s = $s . "}";
	
		$s = $s . "createPolys();";
		
		 $s = $s . "</script>";

echo($s);


?>
</div>
<div id="menu">
	<div id="logo">
    	<a href="http://www.art-basel.org" title="ARt Basel, a new world">
        	<img src="logo.png" border="0" title="ARt Basel, a new world" />
        </a>
    </div>
    <div class="controls">
    				
    	<?php
			$ca = get_categories();
			foreach($ca as $c){
				
				$icon = "http://google-maps-icons.googlecode.com/files/text.png";
		
	
				$icons = $wpdb->get_results("SELECT small_icon FROM wp_reffreffreff_ig_caticons WHERE cat_id =" . $c->term_id );
	
	
		
				if($icons && count($icons)>0){
		
					$icon = get_bloginfo("url") .  "/" .  $icons[0]->small_icon;
				}
				
				?>
                	<a class='clink' href="http://www.art-basel.org/neoreality/index.php?cat=<?php echo( $c->term_id ); ?>" title="view only <?php echo( $c->name ); ?> on the map">
                	<div class="c">
                    	<span class="label">
                    		<?php echo( $c->name ); ?>
                        </span>
                        <span class="image">
   	                    	<img src="<?php echo( $icon ); ?>" title="<?php echo( $c->name ); ?>" border="0" />
                    	</span>
                    </div>
                    </a>
                <?php
				
			}
		?>
        	
            
            		<a class='clink' href="http://www.art-basel.org/neoreality/index.php" title="view all">
                	<div class="c">
                    	<span class="label">
                    		<b>everything</b>
                        </span>
                        <span class="image">
   	                    	
                    	</span>
                    </div>
                    </a>
            
            
    </div>
    
  </div>
    <?php
	
		if(isset($_GET["cat"]) ){
		
		
			$category = get_category($_GET["cat"]);
			
			$icon = "http://google-maps-icons.googlecode.com/files/text.png";
		
	
				$icons = $wpdb->get_results("SELECT small_icon FROM wp_reffreffreff_ig_caticons WHERE cat_id =" . $_GET["cat"] );
	
	
		
				if($icons && count($icons)>0){
		
					$icon = get_bloginfo("url") .  "/" .  $icons[0]->small_icon;
				}
				
				
			?>
            
            <div id="categoryname"><?php echo($category->name); ?> <img src="<?php echo( $icon ); ?>" title="<?php echo( $c->name ); ?>" border="0" /></div>
            
            <?php
		
		}
	
	?>
</body>
</html>