jQuery(document).ready(function() {
	
	//use http://universimmedia.pagesperso-orange.fr/geo/loc.htm to get lat and long coords
	
	
	jQuery.ajax({
		url: "/wp-content/plugins/googlemaploc/php/getLocations.php",
		dataType: 'json'
	}).done(function(json) {
		jQuery('#map_canvas').gmap({
			center: '49.40376, -123.50782',
			 zoom:7,
		}).bind('init', function () {
			
			for (var i = 0; i < json.length; i++) {
			
				try{
				var row = json[i];
				
				if(row.tags && row.tags.length){
				
					if(row.tags.split){
						row.tags = row.tags.split(',');
					}
					
					for(var j = 0; j < row.tags.length; j++){
						row.tags[j] = row.tags[j].trim();
					}
				}
				}catch(e){				
				    console.log("could not parse locations tags", row, e, e.message);
				}
				
				jQuery('#map_canvas').gmap('addMarker',row).click(function(){
					
					/************* START Edit Popup Content Here************/
					var popupContent =
						
					'<span style="font-weight: bold;">' + jQuery(this)[0].name  + '</span> <br />' + 
					jQuery(this)[0].street1 + '<br />';
				
					if( jQuery(this)[0].street2.length && jQuery(this)[0].street2 != '*'){
						popupContent +=jQuery(this)[0].street2 + '<br />';
					}
					popupContent +=
					
					jQuery(this)[0].city + ', BC <br />' + 
					'Canada <br />' + 
					jQuery(this)[0].postal_code + '<br />' + 
					jQuery(this)[0].phone + '<br />' + 
					'<a href="http://'+ jQuery(this)[0].website +'" target="_blank">'+jQuery(this)[0].website +'</a>';
					
					/************* END Edit Popup Content Here************/
					
					jQuery('#map_canvas').gmap('openInfoWindow', {
						'content': popupContent
					}, this);	
				});
			}
		});
	});
	
	var find = function(){
			
		var type = jQuery('#type option:selected').val();
		var area = jQuery('#area option:selected').val();
		
		jQuery('#map_canvas').gmap('find', 'markers', {
			'property': 'tags', 
			'value': [type, area], 
			'operator':'AND'
		}, function(marker, found) { 
			marker.setVisible(found); 			
		}); 		
	}; 		
				
	var reset = function(){
		jQuery('#type').val("Any Type")		
		jQuery('#area').val("Any Area")	
		find();
	};
		
	jQuery('#type').change(find); 		
	jQuery('#area').change(find); 	
	jQuery('#reset').click(reset); 	
		
});