<?php
require_once"wp-config.php";

global $wpdb;



$lat=0;
$lon=0;

if(isset($_GET["lat"]) && isset($_GET["lon"])){


	$lat = $_GET["lat"];
	$lon = $_GET["lon"];


	$d = 0.2;
	
	$q = "SELECT posts.ID as id, p1.meta_value as lat, p2.meta_value as lon, posts.post_title as title, posts.post_content as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2 WHERE posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.meta_key='_geotag_lat' AND p2.meta_key='_geotag_lon' AND p1.meta_value>($lat-$d) AND p1.meta_value<($lat+$d) AND p2.meta_value>($lon-$d) AND p2.meta_value<($lon+$d) ORDER BY posts.post_date DESC LIMIT 0,100";

	//echo($q . "<br /><br />");

	$ru = $wpdb->get_results($q);
	
	$results = array();
	
	if($ru){
	
		for($i=0; $i<count($ru); $i++){
		
			
			$e = $ru[$i];
			
			$e->content = get_bloginfo("url") . "/noARimage.png";
			
			
			$images=get_children( array('post_parent'=>$e->id, 'post_mime_type'=>'image','numberposts'=>1));


			if ( empty($images) ) {
				$e->content = get_bloginfo("url") . "/noARimage.png";
			} else {
			
				$f = true;
				
				foreach ( $images as $attachment_id => $attachment ) {
					
					if($f){
						$ia = wp_get_attachment_image_src( $attachment_id, "small" );
						$e->content = $ia[0];
						$f = false;
					}
				}
			}

		$results[] = $e;
		
		}
	
	
	}
	
	
	$jsonoutput = json_encode($results);

	
	echo($jsonoutput);

}


?>