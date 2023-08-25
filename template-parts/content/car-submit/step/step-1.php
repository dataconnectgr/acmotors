<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$id = '';
if(!empty($args['id'])) {
   $id = $args['id']; 
}
global $jws_option;

?>
<div id="add_car_step1" class="jws-form-row">  
<div class="step-number">
    <span><?php echo esc_html__('Step','idealauto'); ?> 1/5</span><span class="step-text"><?php echo esc_html__('Car Attributes','idealauto'); ?></span>
</div>
<!-- Car Attributes -->

<?php $car_fields = jws_get_car_form_fields(); $required_fields = array( 'year', 'make', 'model', 'condition' ) ; ?>
<div class="section-inner attributes">
    <h4 class="section-title"><?php echo esc_html__('General information','idealauto'); ?></h4>
    <div class="row">
        <div class="col-12 row-item">
            <label><?php echo esc_html__('Ads Title','idealauto');?><abbr> *</abbr></label>
            <?php  
               $title = !empty($id) ? $title = get_the_title($id) : '';
            ?>
            <input id="title_name" class="jws_validate" name="car_data[title]" type="text" placeholder="<?php echo esc_attr_x( '--The displayed title for listing --', 'placeholder', 'idealauto' ); ?>" data-label="<?php echo esc_html__('Ads Title','idealauto'); ?>" value="<?php echo esc_attr($title); ?>"/>
        </div>
        <?php if (!empty($car_fields)){ ?>
            <?php 
				foreach ($car_fields as $field){ 
					$value = '';
					if (!empty($id)) { 
					    $value = array();   
						$cars_taxonomy_array = jws_get_cars_taxonomy();
						$cars_taxonomy = "car_".$field['name']; 
						if( in_array( $cars_taxonomy, $cars_taxonomy_array )) { // For taxonomy
							$taxObj = wp_get_post_terms($id, $cars_taxonomy);
							if( $field['type'] == 'checkbox' ){
								foreach( $taxObj as $obj ){
									$value[] = $obj-> name;
								}
							} else {
								$value = (!empty($taxObj))?$taxObj[0]-> name: '';
							}
						} else { // other than taxonomy
							$value = get_post_meta($id, $field['name'], true);
						}
					}
				if ( in_array( $field['type'], array( 'text', 'number', 'url') ) ){ 
					
					if( $field['type'] == 'url' ){
						$class = 'row-item col-xl-4 col-lg-6 col-12';
					} else {
						$class = 'row-item col-xl-4 col-lg-6 col-12';
					}
                    
				?>	
                <div class="<?php echo esc_attr( $class );?>">
					<div class="form-group">
						<label><?php if(isset($field['icon'] ) && !empty($field['icon'] )) : ?><i class="<?php echo esc_attr($field['icon']); ?>"></i><?php endif; ?><?php echo esc_html( $field['placeholder'] ); echo ( strpos($field['class'], 'jws_validate') !== false )? ' *': ''; ?></label>
							<input
								id="jws-<?php echo esc_attr( $field['name'] ); ?>"
								type="<?php echo esc_attr( $field['type'] ); ?>"
								class="form-control jws-<?php echo esc_attr( $field['name'] ); ?> <?php echo esc_attr( $field['class'] ); ?>"
								data-name="<?php echo esc_attr( $field['name'] ); ?>"
								name="car_data[<?php echo esc_attr( $field['name'] ); ?>]"
								value="<?php echo esc_attr($value); ?>"
								placeholder="-- <?php esc_html_e('Enter', 'idealauto'); ?> <?php echo esc_attr( $field['placeholder'] ); ?> --"
							/>
                            <?php
                           
                                if($field['name'] == 'make' || $field['name'] == 'model' || $field['name'] == 'trim' || $field['name'] == 'body_style' || 
                                 $field['name'] == 'transmission' || $field['name'] == 'engine'|| $field['name'] == 'drivetrain' || $field['name'] == 'exterior_color' ||
                                 $field['name'] == 'fuel_type' || $field['name'] == 'year' || $field['name'] == 'interior_color'  ) :
                                    echo '<div class="jws-search-results"></div>';
                                endif;
                             ?>
                            
					</div> 
				</div>
				<?php 
				}elseif( $field['type'] == 'select' ) {
				
                if($field['name'] == 'vehicle_review_stamps') {
                   $mulri = 'multiple="multiple"'; 
                }else{
                   $mulri = ''; 
                }
              
                    
                ?> 
				<div class="row-item col-xl-4 col-lg-6 col-12">
					<div class="form-group">	
						<label>
                            <?php if(isset($field['icon'] ) && !empty($field['icon'] )) : ?><i class="<?php echo esc_attr($field['icon']); ?>"></i><?php endif; ?>
                            <?php echo esc_html( $field['placeholder'] ); ?>
                            <?php if(in_array($field['name'],$required_fields) ) echo '<abbr>*</abbr>'; ?>
                        </label>
                        <select id="jws-<?php echo esc_attr( $field['name'] ); ?>" class="form-control jws-<?php echo esc_attr( $field['name'] ); ?> <?php echo esc_attr( $field['class'] ); ?>" name="car_data[<?php echo esc_attr( $field['name'] ); ?>]" <?php echo esc_attr($mulri); ?> data-holder="<?php echo esc_attr__( 'Select' ,'idealauto' ).$field['placeholder']; ?>" data-label="<?php echo esc_attr__( $field['placeholder'],'idealauto' ); ?>">
                        <option value="">-- <?php echo esc_html__( 'Select ','idealauto' ).$field['placeholder']; ?> --</option>
                        <?php
    						$first = 0;$i=1;
                            
    						foreach( $field['options'] as $key => $option ){ 
    				             
    							if( strtolower($value) == strtolower($option) ){
    								$checked = 'selected';
    							} else {
    								$checked =  '';
    							}
                             $model_make = ' ';   
    						 if($field['name'] == 'model') {
                                      $term = get_term_by('slug', $key, 'car_model');  
                                      $condition =  get_term_meta( $term->term_id, 'model_of_make', 1 );   
                                      $term = get_term( $condition, 'car_make' );
                                      $model_make = (isset($term->slug)) ? ' data-condition='.esc_attr($term->slug).'' : ' ';     
                                }
    							?>

                                <option<?php echo esc_attr($model_make); ?> value="<?php echo esc_html( $key ); ?>" <?php echo esc_attr($checked); ?>><?php echo esc_attr( $option ); ?></option>
    						
    						<?php
    						  $i++;
                            }?>
                        </select>
					</div>
				</div>		
				<?php
				} 

			} 
            } ?>
    </div>
 </div>
   
<!-- End Car Attributes -->   
  
<!-- Car stamps -->

<?php if(isset($jws_option['car_sub_stamps']) && $jws_option['car_sub_stamps']) : ?>

<div class="section-inner stamps">
    <h4 class="section-title"><?php echo esc_html__('Car review stamps','idealauto'); ?></h4>
    <label><?php echo esc_html__('Vehicle review stamps that your car included','idealauto'); ?></label>
    <div class="row">
    
     <?php 
        $vehicle_review_stamps = get_terms( array( 
            'taxonomy' => 'car_vehicle_review_stamps',
            'orderby' => 'post_date',
            'order'      => 'ASC',
            'hide_empty' => false
        ) );
      
        
        foreach($vehicle_review_stamps as $key => $value) {
            $image = get_term_meta( $value->term_id, 'image' );
            $value_meta = !empty($id) ? get_post_meta($id, 'review_stamps_check_'.$value->slug, true) : ''; 
            $value2  = ($value_meta) ? 'checked=checked' : '';
            $active  = ($value_meta) ? ' active' : '';
			if ( isset( $image ) && ! empty( $image ) ) {
			     $image_url = wp_get_attachment_url( $image[0] ); 
            } 
            $link_value = get_post_meta($id, 'review_stamps_link_'.$value->slug, true);
            ?>
            <div class="col-xl-4 col-lg-4 col-12 stamps-item">
           
                <h5><input type="checkbox" class="checkbox" name="review_stamps_check_<?php echo esc_html($value->slug); ?>" value="<?php echo esc_attr($value_meta); ?>" <?php echo esc_attr($value2); ?> /><?php echo esc_html($value->name); ?></h5>
                <?php 
                    if(isset($image_url)) {
                        echo '<div class="stamp-image"><img src="'.$image_url.'" alt="'.esc_html($value->slug).'"></div>';
                    }
                ?> 
                <div class="link-for-images<?php echo esc_attr($active); ?>">
                    <div class="link-for-images-inner">
                    <h5><?php echo esc_html__('Link:','idealauto'); ?></h5>
                    <input name="review_stamps_link_<?php echo esc_html($value->slug); ?>" placeholder="-- <?php echo esc_attr_x( 'Insert Link', 'placeholder', 'idealauto' ); ?> --" type="text" value="<?php echo esc_attr($link_value); ?>"/>
                    </div>
                </div>
            </div>    
       <?php }  
    ?>
    
    </div>
</div>  

<?php endif; ?>  

<!-- End Car stamps -->  

<!-- Car Maps -->
<?php

    $address = ''; 
    $short_address = '';
    $lat = '43.656081'; 
    $lng = '-79.380171';
    
    if( isset($id) ){
    	$vehicle_location = get_post_meta( $id, 'vehicle_location', true );
        $short_address = get_post_meta( $id, 'short_adress', true );
    	if( !empty( $vehicle_location ) )
    	{
    		$address = $vehicle_location['address'];
    		$lng = $vehicle_location['lng'];
    		$lat = $vehicle_location['lat'];
    	}
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
 <?php if(isset($jws_option['car_sub_location']) && $jws_option['car_sub_location']) : ?>
<div class="section-inner maps">
        <h4 class="section-title"><?php esc_html_e('Vehicle Location', 'idealauto'); ?></h4>
        <label><i class="fas fa-map-marker-alt"></i><?php esc_html_e('Location', 'idealauto'); ?></label>
<div class="map_container">
    <div id="canvas2">

        <input id="pac-input" class="controls" name="car_data[vehicle_location]"  type="text" value="<?php echo esc_attr($address ); ?>"
               placeholder="<?php esc_html_e( "-- Enter a Location --", "idealauto" ) ?>">

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
</div>
<?php endif; ?>

<!-- End Car Maps --> 
   
<div class="step-button">
    <button type="button" class="diable previous" id="prev0"><i class="jws-icon-arrow-left"></i><?php echo esc_html__('Prev','idealauto'); ?></button>
    <button type="button" class="next" id="next1"><?php echo esc_html__('Next','idealauto'); ?><i class="jws-icon-arrow-right"></i></button>
</div>
   
</div>