<?php
require_once"../../../wp-config.php";
?><!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title><?php echo( get_bloginfo("name") ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<style>
body,html{
border: 0px;
margin: 0px;
padding: 0px;
width: 100%;
background: #DDDDDD;
color: #000000;
font: Arial, Helvetica, sans-serif;
}
div.resultblock{
margin: 3px;
padding: 0px;
float: left;
width: 95%;
background: #FFFFFF;
border-bottom: 1px solid #000000;
}
div.resultblockimage{
margin: 0px;
padding: 3px;
float: left;
width: 30%;
}
div.resultblocktext{
margin: 0px;
padding: 3px;
float: left;
width: 60%;
font: bold 16px Arial, Helvetica, sans-serif;
}
a,a:visited{
display: block;
float: left;
width: 100%;
padding: 0px;
margin: 0px;
margin-bottom: 2px;
text-decoration: none;
color: #000000;
}
</style>

</head>
<body>
<div id="contentuto">
<?php


global $wpdb;




	$q = "(SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arimage' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arimage_lat' AND p2.meta_key='neoreality_arimage_lon' AND p3.meta_key='neoreality_arimage_height' AND p4.meta_key='neoreality_arimage_img_url' AND p4.meta_value<>''  ORDER BY posts.post_date DESC LIMIT 0,100)   UNION     (SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arsound' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arsound_lat' AND p2.meta_key='neoreality_arsound_lon' AND p3.meta_key='neoreality_arsound_height' AND p4.meta_key='neoreality_arsound_sound_url' AND p4.meta_value<>'' ORDER BY posts.post_date DESC LIMIT 0,100) UNION         (SELECT posts.ID as id, posts.post_type as type, p1.meta_value as lat, p2.meta_value as lon, p3.meta_value as height, p4.meta_value as imageurl, posts.post_title as title, p4.meta_value as content FROM " . $wpdb->posts . " posts, " . $wpdb->postmeta . " p1, " . $wpdb->postmeta . " p2, " . $wpdb->postmeta . " p3, " . $wpdb->postmeta . " p4 WHERE posts.post_type='arvideo' AND posts.ID=p1.post_id AND p1.post_id=p2.post_id AND p1.post_id=p3.post_id AND p1.post_id=p4.post_id AND p1.meta_key='neoreality_arvideo_lat' AND p2.meta_key='neoreality_arvideo_lon' AND p3.meta_key='neoreality_arvideo_height' AND p4.meta_key='neoreality_arvideo_img_url' AND p4.meta_value<>''  ORDER BY posts.post_date DESC LIMIT 0,100)";

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

		//$results[] = $e;
		
		
			?>
            
            <a href="<?php echo(get_bloginfo("url") . "/wp-content/plugins/neoreality/getARContent.php?id=" . $e->id); ?>" >
            <div class="resultblock">
            	<div class="resultblockimage">
                	<img src="<?php echo( stripslashes($e->content) ); ?>" border="0" width="80" height="80" />
                </div>
                <div class="resultblocktext">
                	<?php echo( stripslashes($e->title) ); ?>
                </div>
            </div>
            </a>
            <?php
		
		
		}
	
	
	}
	

?>
</div>
</body>
</html>