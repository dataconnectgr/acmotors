<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$address = ''; 

$lat = '43.656081'; 
$lng = '-79.380171';
$user = get_userdata( $author );

$vehicle_location =  get_the_author_meta('dealer_location',$user->ID);

if( !empty( $vehicle_location ) )
{
	$address = $vehicle_location['address'];
	$lng = $vehicle_location['lng'];
	$lat = $vehicle_location['lat'];
}
else {
	// get the default
	global $jws_option; $location_exits = true; $lat = $lan = "";
	
	if( isset( $jws_option['default_value_lat'] ) && isset( $jws_option['default_value_long'] ) && !empty( $jws_option['default_value_lat'] ) && !empty( $jws_option['default_value_long'] ) ){
		$lat = $jws_option['default_value_lat'];
		$lng = $jws_option['default_value_long'];
	}
}
?>

<div class="map_container">
    <div id="canvas2">

        <input id="pac-input" class="controls" name="vehicle_location"  type="text" value="<?php echo esc_attr($address ); ?>"
               placeholder="<?php esc_html_e( "Enter a location", "idealauto" ) ?>">

        <div id="type-selector" class="controls control-group">
        
            <input id="cordinats2" type="hidden"  name="location_lat_long" value="<?php echo
			esc_attr( $lat.','.$lng ); ?>"/>

            <input id="formatted_address" data-geo="formatted_address"
                   name="location_formatted_address" type="hidden" value="<?php echo esc_attr($address ); ?>">


            <input type="hidden" id="location_lon" name="jws_lng" value="<?php echo
			esc_attr( $lng ); ?>">
            <input type="hidden" id="location_lat" name="jws_lat" value="<?php echo
			esc_attr( $lat ); ?>">

        </div>
        
    </div>
    <div style="height: 400px;" id="map-canvas"></div>
</div>

<?php
