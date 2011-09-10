<?php
/*
Plugin Name: NeoReality
Plugin URI: http://neoreality.artisopensource.net/
Description: NeoReality transforms your Wordpress blog into an augmented reality publishing system.
Version: 1.0
Author: Salvatore iaconesi
Author URI: http://www.artisopensource.net
License: GPL3
*/
?><?php
/*  Copyright 2011  Salvatore Iaconesi (email : xdxd.vs.xdxd@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as 
    published by the Free Software Foundation.
	
	http://www.gnu.org/licenses/gpl-3.0.html

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

?><?php



define( 'NEOREALITY_FOLDER', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );


// ARIMAGE START

add_action( 'admin_init', 'neoreality_arimage_add_custom_box', 1 );
add_action( 'save_post', 'neoreality_arimage_save_postdata' );
add_action('init', 'neoreality_custom_init');
add_filter('post_updated_messages', 'neoreality_arimage_updated_messages');
add_action( 'contextual_help', 'neoreality_add_help_text', 10, 3 );

function neoreality_arimage_add_custom_box() {
    add_meta_box( 
        'neoreality_arimage_section',
        __( 'Fill in the data about your AR Image', 'neoreality_textdomain' ),
        'neoreality_arimage_inner_custom_box',
        'arimage',
		'normal',
		'high' 
    );
	wp_enqueue_style( "neorealityadmin", NEOREALITY_FOLDER . "admin.css" , array(), false, "all" );
	wp_enqueue_style( "neorealityfileuploaderstyle", NEOREALITY_FOLDER . "fileuploader.css" , array(), false, "all" );
	wp_enqueue_script("neorealityadminjs", NEOREALITY_FOLDER . "js/admin.js" , "jquery", false , true );
	wp_enqueue_script("neorealityadminfileupload", NEOREALITY_FOLDER . "fileuploader.js" , "jquery", false , true );
	wp_enqueue_script("neorealityadmingooglemaps", "http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"  );
}

function neoreality_arimage_inner_custom_box( ) {
  global $post;
  $custom = get_post_custom($post->ID);
  $neoreality_arimage_lat = $custom["neoreality_arimage_lat"][0];
  $neoreality_arimage_lon = $custom["neoreality_arimage_lon"][0];
  $neoreality_arimage_height = $custom["neoreality_arimage_height"][0];
  $neoreality_arimage_img_url = $custom["neoreality_arimage_img_url"][0];
  $neoreality_description = $custom["neoreality_description"][0];
  include( "neoreality_ar_image_edit_panel.php");
}



function neoreality_arimage_save_postdata(  ) {
	global $post;
	$post_id = $post->ID;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		die("");
	if ( 'arimage' == $post->post_type) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) ){
			return $post_id;
		}
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) ){
			return $post_id;
		}
	}
	if(!empty($post_id) ){
		update_custom_meta($post_id,$_POST["neoreality_arimage_lat"],"neoreality_arimage_lat");
		update_custom_meta($post_id,$_POST["neoreality_arimage_lon"],"neoreality_arimage_lon");
		update_custom_meta($post_id,$_POST["neoreality_arimage_height"],"neoreality_arimage_height");
		update_custom_meta($post_id,$_POST["neoreality_arimage_img_url"],"neoreality_arimage_img_url");
		update_custom_meta($post_id,$_POST["neoreality_description"],"neoreality_description");
		return $post_id;
	} else {
		return null;	
	}
}




function neoreality_arimage_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['arimage'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('AR Image updated. <a href="%s">View arimage</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('ARImage updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('ARImage restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('AR Image published. <a href="%s">View ARImage</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('AR Image saved.'),
    8 => sprintf( __('AR Image submitted. <a target="_blank" href="%s">Preview AR Image</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('AR Image scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview AR Image</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('AR Image draft updated. <a target="_blank" href="%s">Preview AR Image</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}



// ARIMAGE END













// ARVIDEO START

add_action( 'admin_init', 'neoreality_arvideo_add_custom_box', 1 );
add_action( 'save_post', 'neoreality_arvideo_save_postdata' );
add_filter('post_updated_messages', 'neoreality_arvideo_updated_messages');

function neoreality_arvideo_add_custom_box() {
    add_meta_box( 
        'neoreality_arvideo_section',
        __( 'Fill in the data about your AR Video Embed', 'neoreality_textdomain' ),
        'neoreality_arvideo_inner_custom_box',
        'arvideo',
		'normal',
		'high' 
    );
	wp_enqueue_style( "neorealityadmin", NEOREALITY_FOLDER . "admin.css" , array(), false, "all" );
	wp_enqueue_style( "neorealityfileuploaderstyle", NEOREALITY_FOLDER . "fileuploader.css" , array(), false, "all" );
	wp_enqueue_script("neorealityadminjs", NEOREALITY_FOLDER . "js/admin.js" , "jquery", false , true );
	wp_enqueue_script("neorealityadminfileupload", NEOREALITY_FOLDER . "fileuploader.js" , "jquery", false , true );
	wp_enqueue_script("neorealityadmingooglemaps", "http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"  );
}

function neoreality_arvideo_inner_custom_box( ) {
  global $post;
  $custom = get_post_custom($post->ID);
  $neoreality_arvideo_lat = $custom["neoreality_arvideo_lat"][0];
  $neoreality_arvideo_lon = $custom["neoreality_arvideo_lon"][0];
  $neoreality_arvideo_height = $custom["neoreality_arvideo_height"][0];
  $neoreality_arvideo_img_url = $custom["neoreality_arvideo_img_url"][0];
  $neoreality_description = $custom["neoreality_description"][0];
  $neoreality_embed = $custom["neoreality_embed"][0];
  include( "neoreality_ar_video_edit_panel.php");
}



function neoreality_arvideo_save_postdata(  ) {
	global $post;
	$post_id = $post->ID;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		die("");
	if ( 'arimage' == $post->post_type) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) ){
			return $post_id;
		}
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) ){
			return $post_id;
		}
	}
	if(!empty($post_id) ){
		update_custom_meta($post_id,$_POST["neoreality_arimage_lat"],"neoreality_arvideo_lat");
		update_custom_meta($post_id,$_POST["neoreality_arimage_lon"],"neoreality_arvideo_lon");
		update_custom_meta($post_id,$_POST["neoreality_arimage_height"],"neoreality_arvideo_height");
		update_custom_meta($post_id,$_POST["neoreality_arimage_img_url"],"neoreality_arvideo_img_url");
		update_custom_meta($post_id,$_POST["neoreality_description"],"neoreality_description");
		update_custom_meta($post_id,$_POST["neoreality_embed"],"neoreality_embed");
		return $post_id;
	} else {
		return null;	
	}
}




function neoreality_arvideo_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['arvideo'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('AR Video updated. <a href="%s">View arvideo</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('ARVideo updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('ARVideo restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('AR Video published. <a href="%s">View ARVideo</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('AR Image saved.'),
    8 => sprintf( __('AR ARVideo submitted. <a target="_blank" href="%s">Preview AR ARVideo</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('AR Video scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview AR Video</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('AR Video draft updated. <a target="_blank" href="%s">Preview AR Video</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}



// ARVIDEO END



























// ARSOUND START

add_action( 'admin_init', 'neoreality_arsound_add_custom_box', 1 );
add_action( 'save_post', 'neoreality_arsound_save_postdata' );
add_filter('post_updated_messages', 'neoreality_arsound_updated_messages');


function neoreality_arsound_add_custom_box() {
    add_meta_box( 
        'neoreality_arsound_section',
        __( 'Fill in the data about your AR Sound', 'neoreality_textdomain' ),
        'neoreality_arsound_inner_custom_box',
        'arsound',
		'normal',
		'high' 
    );
}

function neoreality_arsound_inner_custom_box( ) {
  global $post;
  $custom = get_post_custom($post->ID);
  $neoreality_arsound_lat = $custom["neoreality_arsound_lat"][0];
  $neoreality_arsound_lon = $custom["neoreality_arsound_lon"][0];
  $neoreality_arsound_height = $custom["neoreality_arsound_height"][0];
  $neoreality_arsound_sound_url = $custom["neoreality_arsound_sound_url"][0];
  $neoreality_description = $custom["neoreality_description"][0];
  include( "neoreality_ar_sound_edit_panel.php");
}



function neoreality_arsound_save_postdata(  ) {
	global $post;
	$post_id = $post->ID;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		die("");
	if ( 'arsound' == $post->post_type) 
	{
		if ( !current_user_can( 'edit_page', $post_id ) ){
			return $post_id;
		}
	}
	else
	{
		if ( !current_user_can( 'edit_post', $post_id ) ){
			return $post_id;
		}
	}
	if(!empty($post_id) ){
		update_custom_meta($post_id,$_POST["neoreality_arimage_lat"],"neoreality_arsound_lat");
		update_custom_meta($post_id,$_POST["neoreality_arimage_lon"],"neoreality_arsound_lon");
		update_custom_meta($post_id,$_POST["neoreality_arimage_height"],"neoreality_arsound_height");
		update_custom_meta($post_id,$_POST["neoreality_arimage_sound_url"],"neoreality_arsound_sound_url");
		update_custom_meta($post_id,$_POST["neoreality_description"],"neoreality_description");
		return $post_id;
	} else {
		return null;	
	}
}







  



function neoreality_arsound_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['arsound'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('AR Sound updated. <a href="%s">Get sound</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('ARSound updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('ARSound restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('AR Sound published. <a href="%s">View ARSound</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('AR Sound saved.'),
    8 => sprintf( __('AR Sound submitted. <a target="_blank" href="%s">Preview AR Sound</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('AR Sound scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview AR Sound</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('AR Sound draft updated. <a target="_blank" href="%s">Preview AR Sound</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}



// ARSOUND END














function neoreality_custom_init() 
{
	
	
	// **********
	//ARIMAGE
	// **********
  $labels = array(
    'name' => _x('ARImage', 'post type general name'),
    'singular_name' => _x('ARImage', 'post type singular name'),
    'add_new' => _x('Add New', 'arimage'),
    'add_new_item' => __('Add New ARImage'),
    'edit_item' => __('Edit ARImage'),
    'new_item' => __('New ARImage'),
    'all_items' => __('All ARImages'),
    'view_item' => __('View ARImage'),
    'search_items' => __('Search ARImages'),
    'not_found' =>  __('No arimages found'),
    'not_found_in_trash' => __('No arimages found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'AR Content'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    //'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	'supports' => array('title','thumbnail','comments')
  ); 
  register_post_type('arimage',$args);

	
	
	
	
	
	
	
	
	
	
	
	// **********
	//ARVIDEO
	// **********
  $labels = array(
    'name' => _x('ARVideo', 'post type general name'),
    'singular_name' => _x('ARVideo', 'post type singular name'),
    'add_new' => _x('Add New', 'arvideo'),
    'add_new_item' => __('Add New ARVideo'),
    'edit_item' => __('Edit ARVideo'),
    'new_item' => __('New ARVideo'),
    'all_items' => __('All ARVideos'),
    'view_item' => __('View ARVideo'),
    'search_items' => __('Search ARVideos'),
    'not_found' =>  __('No arvideos found'),
    'not_found_in_trash' => __('No arvideos found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'AR Content'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    //'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	'supports' => array('title','thumbnail','comments')
  ); 
  register_post_type('arvideo',$args);

	
	
	
	
	
	
	
	
	// **********
	//ARSOUND
	// **********
  $labelss = array(
    'name' => _x('ARSound', 'post type general name'),
    'singular_name' => _x('ARSound', 'post type singular name'),
    'add_new' => _x('Add New', 'arsound'),
    'add_new_item' => __('Add New ARSound'),
    'edit_item' => __('Edit ARSound'),
    'new_item' => __('New ARSound'),
    'all_items' => __('All ARSounds'),
    'view_item' => __('View ARSound'),
    'search_items' => __('Search ARSounds'),
    'not_found' =>  __('No arsounds found'),
    'not_found_in_trash' => __('No arsounds found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'AR Content'

  );
  $argss = array(
    'labels' => $labelss,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    //'supports' => array('title','editor','author','thumbnail','excerpt','comments')
	'supports' => array('title','thumbnail','comments')
  ); 
  register_post_type('arsound',$argss);

	register_taxonomy("artypes", array("arimage","arsound", "arvideo"), array("hierarchical" => true, "label" => "AR Content Types", "singular_label" => "AR Content type", "rewrite" => true));
	
	
	


}

















function update_custom_meta($postID, $newvalue, $field_name) {
    // To create new meta
    if(!get_post_meta($postID, $field_name)){
    add_post_meta($postID, $field_name, $newvalue);
    }else{
    // or to update existing meta
    update_post_meta($postID, $field_name, $newvalue);
    }
}



function neoreality_add_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('arimage' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a book:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct writer of the book.  Remember that the Author module refers to you, the author of this book review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the book review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-arimage' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of books blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
}
?>