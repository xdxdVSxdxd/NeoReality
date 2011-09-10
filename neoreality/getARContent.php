<?php
require_once"../../../wp-config.php";

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />
<title><?php echo( get_bloginfo("name") ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

<style>
html,body{
margin:8px;
padding:0px;
width:100%;
background:#FFFFFF;
font: 12px Arial, Helvetica, sans-serif;
}

div#contenuto{
	
	width:100%;
	padding:0px;
	margin:0px;
	
}

div.heading{
	
	padding: 5px;
	margin: 2px;
	font: bold 20px Arial, Helvetica, sans-serif;
	color: #000000;
}


div.post-body{
	
	padding: 5px;
	margin: 2px;
	font: 14px Arial, Helvetica, sans-serif;
	color: #444444;
}

</style>
</head>
<body>
<div id="contentuto">
<?php


if(isset($_GET["id"])){

	
	$p = get_post($_GET["id"]);
	
	if($p){
		
		if($p->post_type=="post"){
		
			?>
			
			<div class="heading"><?php echo($p->post_title); ?></div>
			<div class="post-body"><?php echo(  do_shortcode(nl2br($p->post_content)) ); ?></div>
			
			<?php
		}
		
		
		else if($p->post_type=="arimage"){
			
			$custom = get_post_custom($p->ID);
			
			//print_r($custom);
			
		?>
			<div class="heading"><?php echo($p->post_title); ?></div>
			<div class="post-body">
            	<img src="<?php echo($custom["neoreality_arimage_img_url"][0]); ?>" border="0" />
                <br />
            	<p>
                	<?php echo($custom["neoreality_description"][0]); ?>
                </p>
            </div>
		<?php
        }
		
		
		else if($p->post_type=="arvideo"){
			
			$custom = get_post_custom($p->ID);
			
			//print_r($custom);
			
		?>
			<div class="heading"><?php echo($p->post_title); ?></div>
			<div class="post-body">
            	<?php echo($custom["neoreality_embed"][0]); ?>
                <br />
            	<p>
                	<?php echo($custom["neoreality_description"][0]); ?>
                </p>
            </div>
		<?php
        }
		
		else if($p->post_type=="arsound"){
			
			$custom = get_post_custom($p->ID);
			
		?>
			<div class="heading"><?php echo($p->post_title); ?></div>
			<div class="post-body">
            
            
            
            <?php
				
				$neoreality_arsound_sound_url = $custom["neoreality_arsound_sound_url"][0];
            
			
				if(!empty($neoreality_arsound_sound_url)){
					
					
					$mime = "audio/mp3";
					
					if(EndsWith($neoreality_arsound_sound_url, "wav")||EndsWith($neoreality_arsound_sound_url, "WAV")){
					
						$mime = "audio/wav";
						
					}
					
					?>
                    
                    <audio controls="controls">
                      <source src="<?php echo($neoreality_arsound_sound_url); ?>" type="<?php echo($mime); ?>" />
                      Your browser does not support the audio element.
                    </audio>
                                        
                    <?php
					
					
				} else {
				?>	
				A sound hasn't been loaded yet.
                <?php
				}
				
			
			
			?>
            
            	<br />
            	<p>
                	<?php echo($custom["neoreality_description"][0]); ?>
                </p>
            
            </div>
		<?php
		}
		
	}

}

?>
<?php


function EndsWith($FullStr, $EndStr)
{
        // Get the length of the end string
    $StrLen = strlen($EndStr);
        // Look at the end of FullStr for the substring the size of EndStr
    $FullStrEnd = substr($FullStr, strlen($FullStr) - $StrLen);
        // If it matches, it does end with EndStr
    return $FullStrEnd == $EndStr;
}


?>
</div>
</body>
</html>