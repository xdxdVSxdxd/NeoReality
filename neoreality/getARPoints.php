<?php
require_once"../../../wp-config.php";

global $wpdb;



$lat=0;
$lon=0;

if(isset($_GET["lat"]) && isset($_GET["lon"])){


	$lat = $_GET["lat"];
	$lon = $_GET["lon"];


	$d = 0.2;
	
	$q = "(SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arimage' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arimage_lat' AND p2.meta_key='neoreality_arimage_lon' AND p3.meta_key='neoreality_arimage_height' AND p4.meta_key='neoreality_arimage_img_url' AND p4.meta_value<>'' AND p1.meta_value>($lat-$d) AND p1.meta_value<($lat+$d) AND p2.meta_value>($lon-$d) AND p2.meta_value<($lon+$d)  ORDER BY posts.post_date DESC LIMIT 0,100)   UNION     (SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arsound' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arsound_lat' AND p2.meta_key='neoreality_arsound_lon' AND p3.meta_key='neoreality_arsound_height' AND p4.meta_key='neoreality_arsound_sound_url' AND p4.meta_value<>'' AND p1.meta_value>($lat-$d) AND p1.meta_value<($lat+$d) AND p2.meta_value>($lon-$d) AND p2.meta_value<($lon+$d)  ORDER BY posts.post_date DESC LIMIT 0,100) UNION         (SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arvideo' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arvideo_lat' AND p2.meta_key='neoreality_arvideo_lon' AND p3.meta_key='neoreality_arvideo_height' AND p4.meta_key='neoreality_arvideo_img_url' AND p4.meta_value<>'' AND p1.meta_value>($lat-$d) AND p1.meta_value<($lat+$d) AND p2.meta_value>($lon-$d) AND p2.meta_value<($lon+$d)  ORDER BY posts.post_date DESC LIMIT 0,100)";

	//echo($q . "<br /><br />");

	$ru = $wpdb->get_results($q);
	
	$results = array();
	
	if($ru){
	
		for($i=0; $i<count($ru); $i++){
		
			
			$e = $ru[$i];
			
			
			//$e->content = get_bloginfo("url") . "/wp-content/plugins/neoreality/noARimage.png";
			
			$e->altitude = "0";
			
			$custom_fields = get_post_custom($e->id);
			
			if($custom_fields && count($custom_fields)){
			
				
				if(isset($custom_fields["neoreality_arsound_height"])){
				
					$e->altitude = $custom_fields["neoreality_arsound_height"][0];
				} else if(isset($custom_fields["neoreality_arimage_height"])){
				
					$e->altitude = $custom_fields["neoreality_arimage_height"][0];
				}
			
			}
			
			
			if($e->type=="arimage"){
					
				if(isset($e->imageurl) && $e->imageurl<>""){
					$e->content = $e->imageurl;
				} else {
					$e->content = get_bloginfo("url") . "/wp-content/plugins/neoreality/noARimage.png";	
				}
					
			} else if($e->type=="arsound"){
					
				if(isset($e->imageurl) && $e->imageurl<>""){
					$e->content = get_bloginfo("url") . "/wp-content/plugins/neoreality/ARSound.png";;
				} else {
					$e->content = get_bloginfo("url") . "/wp-content/plugins/neoreality/noARimage.png";	
				}
					
			}
			
			
			
			/*
			
			past versions: keeping it for debug reasons
			
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
			
			*/

		$results[] = $e;
		
		}
	
	
	}
	
	
	$jsonoutput = json_encode($results);

	
	echo($jsonoutput);

}


?>