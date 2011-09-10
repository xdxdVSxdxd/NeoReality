<div class="neoreality_ar_image_edit_panel">
	<div class="neoreality_admin_description">
		<em>This panel helps you create an <strong>AR Image</strong> content.</em>
	</div>
    <div id="neoreality_admin_edit_general_panel">
        <div class="neoreality_admin_manual_panels">
            <label>Latitude</label>
            <input type="text" id="neoreality_arimage_lat" name="neoreality_arimage_lat" value="<?php if(!empty($neoreality_arvideo_lat)) echo $neoreality_arvideo_lat; ?>"/>
            <label>Longitude</label>
            <input type="text" id="neoreality_arimage_lon" name="neoreality_arimage_lon" value="<?php
            if(!empty($neoreality_arvideo_lon)) echo $neoreality_arvideo_lon;
            ?>"/>
            <label>Height (in meters)</label>
            <input type="text" id="neoreality_arimage_height" name="neoreality_arimage_height" value="<?php
            if(!empty($neoreality_arvideo_height)) echo $neoreality_arvideo_height;
            ?>"/>
            <label>Description</label>
            <textarea cols="40" rows="10" id="neoreality_description" name="neoreality_description"><?php
            if(!empty($neoreality_description)) echo $neoreality_description;
            ?></textarea>
            <label>Video Embed Code (Youtube, Vimeo)</label>
            <textarea cols="40" rows="10" id="neoreality_embed" name="neoreality_embed"><?php
            if(!empty($neoreality_embed)) echo $neoreality_embed;
            ?></textarea>
            
            <label>Image URL (jpg,png)</label>
            <input type="hidden" id="neoreality_arimage_img_url" name="neoreality_arimage_img_url" value="<?php
            if(!empty($neoreality_arvideo_img_url)) echo $neoreality_arvideo_img_url;
            ?>"/>
            
            
            
            <div id="imageupload">		
				<noscript>			
					<p>Please enable JavaScript to use file uploader.</p>
					<!-- or put a simple form for upload here -->
				</noscript>         
			</div>
            <script>        
        		function createImageUploader(){            
            		var uploader = new qq.FileUploader({
                		element: document.getElementById('imageupload'),
                		action: '<?php echo( WP_PLUGIN_URL ); ?>/neoreality/upload.php',
						allowedExtensions: ['jpg','png'],
                		debug: false,
						onSubmit: function(id, fileName){ 
							//alert(fileName + "-_--" + id); 
						},
						onComplete: function(id, fileName, responseJSON){
							if(responseJSON.success && responseJSON.success==true){
								//alert(responseJSON.destpath);
								jQuery("input#neoreality_arimage_img_url").val(responseJSON.destpath);
								jQuery("img#demoimage").attr("src",responseJSON.destpath);
							} else if(responseJSON.error){
								alert(responseJSON.error);
							} else {
								alert("an error prevented the file from being uploaded, please contact webmaster.");
							}
							
						}
            		});           
        		}
				

    		</script>
            
            
            <img border="0" id="demoimage" src="<?php
            if(!empty($neoreality_arvideo_img_url)) echo $neoreality_arvideo_img_url;
            ?>"/>
            
            
            
            
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

	createImageUploader();
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