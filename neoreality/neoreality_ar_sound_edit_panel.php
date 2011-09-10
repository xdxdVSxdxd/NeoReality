<div class="neoreality_ar_image_edit_panel">
	<div class="neoreality_admin_description">
		<em>This panel helps you create an <strong>AR Sound</strong> content.</em>
	</div>
    <div id="neoreality_admin_edit_general_panel">
        <div class="neoreality_admin_manual_panels">
            <label>Latitude</label>
            <input type="text" id="neoreality_arimage_lat" name="neoreality_arimage_lat" value="<?php if(!empty($neoreality_arsound_lat)) echo $neoreality_arsound_lat; ?>"/>
            <label>Longitude</label>
            <input type="text" id="neoreality_arimage_lon" name="neoreality_arimage_lon" value="<?php
            if(!empty($neoreality_arsound_lon)) echo $neoreality_arsound_lon;
            ?>"/>
            <label>Height (in meters)</label>
            <input type="text" id="neoreality_arimage_height" name="neoreality_arimage_height" value="<?php
            if(!empty($neoreality_arsound_height)) echo $neoreality_arsound_height;
            ?>"/>
            <label>Description</label>
            <textarea cols="40" rows="10" id="neoreality_description" name="neoreality_description"><?php
            if(!empty($neoreality_description)) echo $neoreality_description;
            ?></textarea>
            <label>Sound URL (wav,mp3)</label>
            <input type="hidden" id="neoreality_arimage_sound_url" name="neoreality_arimage_sound_url" value="<?php
            if(!empty($neoreality_arsound_sound_url)) echo $neoreality_arsound_sound_url;
            ?>"/>
            
            
            
            <div id="imageupload">		
				<noscript>			
					<p>Please enable JavaScript to use file uploader.</p>
					<!-- or put a simple form for upload here -->
				</noscript>         
			</div>
            <script>        
        		function createSoundUploader(){            
            		var uploader = new qq.FileUploader({
                		element: document.getElementById('imageupload'),
                		action: '<?php echo( WP_PLUGIN_URL ); ?>/neoreality/upload.php',
						allowedExtensions: ['wav','mp3'],
                		debug: false,
						onSubmit: function(id, fileName){ 
							//alert(fileName + "-_--" + id); 
						},
						onComplete: function(id, fileName, responseJSON){
							if(responseJSON.success && responseJSON.success==true){
								//alert(responseJSON.destpath);
								jQuery("input#neoreality_arimage_sound_url").val(responseJSON.destpath);
								
								var mime = "audio/mp3";
								//controllare se è wav
								
									
								var ht = "<audio controls='controls'><source src='" + responseJSON.destpath + "' type='" + mime + "' />Your browser does not support the audio element.</audio>";
								
								jQuery("div#sound").html(ht);
								
							} else if(responseJSON.error){
								alert(responseJSON.error);
							} else {
								alert("an error prevented the file from being uploaded, please contact webmaster.");
							}
							
						}
            		});           
        		}
				

    		</script>
            
            
            <div id="sound">
            <?php
			
			
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
            </div>
            
            
            
        </div>
        <div class="neoreality_admin_mappanel">
            <div id="neoreality_map_edit">
                <div id="neoreality_map_canvas" style="width:100%; height:100%"></div>
            </div>
            <div id="neoreality_map_parameters">
                <strong>Search for address</strong> <em>(please enter street, city, country)</em><br />
                <input type="text" id="neoreality_search_address" name="neoreality_search_address" value="" /><br />
                <input type="button" value="SEARCH" onclick="neoreality_search_address_call();" />
            </div>
        </div> 
        <div style="width:100% padding: 0px; margin:0px; clear:both;">&nbsp;</div> 
	</div>
</div>





<div id="loaddestination" style="display:none"></div>

<script type="text/javascript">


function createAllUploaders(){

	createSoundUploader();
	createOnchangers();
}



function createOnchangers(){
	
	
	jQuery("input#neoreality_arimage_lat, input#neoreality_arimage_lon").change(function(){
	
		currentPosition = new google.maps.LatLng(jQuery("input#neoreality_arimage_lat").val(), jQuery("input#neoreality_arimage_lon").val());
		currentMarker.setPosition(currentPosition);	
		map.setCenter(currentPosition);
		
	});
	
}

window.onload = createAllUploaders;
</script>





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