<?php
require_once"wordpress/wp-config.php";

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title>ARt Basel, a new world for art</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
jQuery.noConflict();
</script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<script type="text/javascript">



jQuery(document).ready(function(){
   
   /*
   jQuery("a").fancybox(
   		{
        	'autoDimensions'	: false,
			'width'         		: 600,
			'height'        		: 500,
			'transitionIn'		: 'elastic',
			'type'				: 'iframe',
			'transitionOut'		: 'fade',
			'scrolling'			: 'auto'
		}
	);//attr({target: "_blank"});

	*/
	
	jQuery("a").each(function(){
   
   	var hr = jQuery(this).attr("href");
	jQuery(this).attr("href" , "http://www.art-basel.org/neoreality/openexternal.php?url=" + hr );
	jQuery(this).attr("target" , "_blank" );
   
   });

});

</script>

<style>
html,body{
margin:0px;
padding:0px;
width:100%;
height:100%;
background:#FFFFFF;
font: 12px Arial, Helvetica, sans-serif;
}
div#contentuto,div#cos-general-map{
margin:0px;
padding:0px;
width:100%;
height:100%;
background:#FFFFFF;

}

div.heading{
font: bold 20px Arial, Helvetica, sans-serif;
color: #333333;
float: left;
width: 100%;
margin: 0px;
padding: 0px;
margin-bottom: 32px;
}

div.post-body{
font: 12 Arial, Helvetica, sans-serif;
color: #555555;
float: left;
width: 100%;
margin: 0px;
padding: 0px;
margin-bottom: 32px;
line-height: 16px;
}

div.post-body div{
float: left;
width: 100%;
margin: 0px;
padding: 0px;
}

div.post-body div div{
float: left;
width: 100%;
margin: 0px;
padding: 0px;
margin-top: 16px;
margin-bottom: 16px;
text-align: center;
}

div.post-body div div a{
float: left;
width: 100%;
margin: 0px;
padding: 0px;
text-align: center;
}

div.post-body a, div.post-body a:visited{
color: #E1001A;
text-decoration:none;
font: bold 12 Arial, Helvetica, sans-serif;
}

div.post-body a:hover{
color: #E1001A;
text-decoration:underline;
}

img{
border: 0px;
}

</style>
</head>
<body>
<div id="contentuto">
<?php


if(isset($_GET["id"])){

	
	$p = get_post($_GET["id"]);
	
	if($p){
		?>
        
        <div class="heading"><?php echo($p->post_title); ?></div>
        <div class="post-body"><?php echo(  do_shortcode(nl2br($p->post_content)) ); ?></div>
        
        <?php
	
	}

}

?>
</div>
</body>
</html>