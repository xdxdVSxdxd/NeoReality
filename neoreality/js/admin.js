var map;
var currentPosition;
var currentHeight;
var currentMarker;
var geocoder;

function initialize() {
	
	//alert(jQuery("input#neoreality_arimage_lat").val());
	
	currentPosition = new google.maps.LatLng(jQuery("input#neoreality_arimage_lat").val(), jQuery("input#neoreality_arimage_lon").val());
	currentHeight = jQuery("input#neoreality_arimage_height").val();
	
	geocoder = new google.maps.Geocoder();
	var myOptions = {
	  zoom: 1,
	  center: currentPosition,
	  mapTypeId: google.maps.MapTypeId.HYBRID
	};
	map = new google.maps.Map(document.getElementById("neoreality_map_canvas"), myOptions);
	
	currentMarker = new google.maps.Marker({
      position: currentPosition,
	  draggable:true,
	  animation: google.maps.Animation.DROP,
      title:"the current selected position"
  	});
	currentMarker.setMap(map);
	
				google.maps.event.addListener(currentMarker, "dragend", function() {
                    var center = currentMarker.getPosition();
                    jQuery("input#neoreality_arimage_lat").val(center.lat());
					jQuery("input#neoreality_arimage_lon").val(center.lng());
                });
				

				
				google.maps.event.addListener(map, "dblclick", function(event) {
                    var center = event.latLng;
					currentMarker.setPosition(center);
					//map.setCenter(center);
                    jQuery("input#neoreality_arimage_lat").val(center.lat());
					jQuery("input#neoreality_arimage_lon").val(center.lng());
                });
	
	jQuery("input#neoreality_arimage_lat").val(currentPosition.lat());
	jQuery("input#neoreality_arimage_lon").val(currentPosition.lng());
	jQuery("input#neoreality_arimage_height").val(currentHeight);
	
	
}



initialize();


function neoreality_search_address_call(){
	
	
	var address = jQuery("input#neoreality_search_address").val();
	if(address!=""){
		
		
		geocoder.geocode( { 'address': address}, function(results, status) {
		
			if (status == google.maps.GeocoderStatus.OK) {
				
				map.setCenter(results[0].geometry.location);
				map.setZoom(8);
				currentMarker.setPosition(results[0].geometry.location);
				jQuery("input#neoreality_arimage_lat").val(results[0].geometry.location.lat());
				jQuery("input#neoreality_arimage_lon").val(results[0].geometry.location.lng());
			
			} else {
				
				alert("It was not possible to find your address, for the following reason: " + status);
			}

		});
		
		
	} else {
		alert("please enter an address in the search field.");	
	}
	
}