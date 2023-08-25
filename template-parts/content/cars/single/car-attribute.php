<div class="car-single-attribute">
    <?php
        
        $custom_attr = jws_theme_get_option('cars_grid_attr_single');
    
        $fuel        = get_the_terms( get_the_ID(), 'car_fuel_type' );
    	$mileage      = get_the_terms( get_the_ID(), 'car_mileage' );
        $engine       = get_the_terms( get_the_ID(), 'car_engine' );
        $body       = get_the_terms( get_the_ID(), 'car_body_style' );
        $transmission       = get_the_terms( get_the_ID(), 'car_transmission' ); 
        $fuel_economy       = get_the_terms( get_the_ID(), 'car_fuel_economy' );
        
    	$car_mileage = '';
        $car_fuel = '';
        $car_engine  = '';
        $car_body = '';
        $car_transmission = '';
        $car_fuel_economy  = '';


        $label_fuel = '<span class="label">'.esc_html__('FUEL TYPE','idealauto').'</span>';
        $label_mileage = '<span class="label">'.esc_html__('MILEAGE','idealauto').'</span>';
        $label_engine = '<span class="label">'.esc_html__('ENGINE','idealauto').'</span>';
        $label_car_type = '<span class="label">'.esc_html__('CAR TYPE','idealauto').'</span>';
        $label_transmission  = '<span class="label">'.esc_html__('TRANSMISSION','idealauto').'</span>';
        $label_fuel_economy  = '<span class="label">'.esc_html__('FUEL ECONOMY','idealauto').'</span>';
 
        
        
        if ( ! is_wp_error( $fuel ) && isset( $fuel[0]->name ) ) {
    		$car_fuel = $fuel[0]->name;
    	}
        if ( ! is_wp_error( $engine ) && isset( $engine[0]->name ) ) {
    		$car_engine = $engine[0]->name;
    	}
    	if ( ! is_wp_error( $mileage ) && isset( $mileage[0]->name ) ) {
    		$car_mileage = $mileage[0]->name;
    	}
        if ( ! is_wp_error( $body ) && isset( $body[0]->name ) ) {
    		$car_body = $body[0]->name;
    	}
        if ( ! is_wp_error( $transmission ) && isset( $transmission[0]->name ) ) {
    		$car_transmission = $transmission[0]->name;
    	}
        if ( ! is_wp_error( $fuel_economy ) && isset( $fuel_economy[0]->name ) ) {
    		$car_fuel_economy = $fuel_economy[0]->name;
    	}
        ob_start(); 
        
        echo '<div class="car-list"><ul class="ct_ul_ol">';
        
        
        
        if(jws_theme_get_option('cars_grid_attr_enable_single')  && !empty($custom_attr['car_field'])) {
                    
         foreach($custom_attr['car_field'] as $key => $value) {
       
               $value_attr = get_the_terms( get_the_ID() ,$value );

               if ( ! is_wp_error( $value_attr ) && isset( $value_attr[0]->name ) )  {
                   $label_value = $value_attr[0]->name;
               }else {
                   $label_value = '';
               }
               
               ?>
               
               <li ><img src="<?php echo esc_url($custom_attr['icon'][$key]['url']); ?>" alt="img_attr">
                    <span class="attr-text">  
                        <?php 
                        
                        echo '<span class="label">'.$custom_attr['label'][$key].'</span>';  
                        
                        echo $label_value; 
                        
                        ?>
                    </span>
                </li>
                
                <?php
                
            }
            
        }else {
        
        
        
        if ( ! empty( $car_fuel ) ) {
    		?><li ><i class="jws-icon-007-fuel"></i><span class="attr-text"><?php echo $label_fuel.esc_html( $car_fuel ); ?></span></li> <?php
    	}
        if ( $car_mileage ) {
    		?> <li><i class="jws-icon-001-road-perspective"></i><span class="attr-text"><?php echo $label_mileage. esc_html( $car_mileage ); ?></span></li> <?php
    	}
        if ( ! empty( $car_engine ) ) {
    		?> <li><i class="jws-icon-002-engine"></i><span class="attr-text"><?php echo $label_engine. esc_html( $car_engine ); ?></span></li> <?php
    	}
        if ( ! empty( $car_body ) ) {
    		?> <li><i class="jws-icon-car2"></i><span class="attr-text"><?php echo $label_car_type. esc_html( $car_body ); ?></span></li> <?php
    	}
        if ( ! empty( $car_transmission ) ) {
    		?> <li><i class="jws-icon-001-manual-transmission"></i><span class="attr-text"><?php echo $label_transmission. esc_html( $car_transmission ) ; ?></span></li> <?php
    	}
        if ( ! empty( $car_fuel_economy ) ) {
    		?> <li><i class="jws-icon-oil"></i><span class="attr-text"><?php echo $label_fuel_economy. esc_html( $car_fuel_economy ) ; ?></span></li> <?php
    	}
        
        }
        ?>  
    		</ul></div>
        <?php    
        $attributs = ob_get_clean(); 
        echo apply_filters( 'jws_get_cars_list_attribute_grid_single', $attributs ); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotE
    ?>
</div>    