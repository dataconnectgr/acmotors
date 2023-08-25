<?php
/**
 * Template part.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CarDealer
 */

global $jws_option;

$location_exist = false;
$lat            = '';
$lan            = '';

$car_id   = get_the_ID();
$location = get_post_meta( $car_id, 'vehicle_location', true );

$vehicle_overview = get_post_meta( $car_id, 'vehicle_overview', true );
if ( ! empty( $location ) ) {
	$location_exist = true;
}

$vehicle_overview_display         = ( isset( $jws_option['cars-vehicle-overview-option'] ) ) ? $jws_option['cars-vehicle-overview-option'] : 1;
$car_features_options_display     = ( isset( $jws_option['cars-features-options-option'] ) ) ? $jws_option['cars-features-options-option'] : 1;
$technical_specifications_display = ( isset( $jws_option['cars-technical-specifications-option'] ) ) ? $jws_option['cars-technical-specifications-option'] : 1;
$general_information_display      = ( isset( $jws_option['cars-general-information-option'] ) ) ? $jws_option['cars-general-information-option'] : 1;
$location_display                 = ( isset( $jws_option['cars-vehicle-location-option'] ) ) ? $jws_option['cars-vehicle-location-option'] : 1;
$car_features_options = get_the_terms( get_the_ID() , 'car_features_options');
if ( $vehicle_overview_display || $car_features_options_display || $technical_specifications_display || $general_information_display || $location_display ) {
	?>
	<div class="car-single-tabs car-tabs">
		<ul class="tabs-nav ct_ul_ol">
			<?php

			if ( $vehicle_overview_display ) {
				
					?>
					<li data-tabs="tab1" class="active"><?php esc_html_e( 'Overview', 'idealauto' ); ?></li>
					<?php
			
			}

			if ( $car_features_options_display ) {
				

				if ( ! empty( $car_features_options ) ) {
					?>
					<li data-tabs="tab2"><?php esc_html_e( 'Features & Options', 'idealauto' ); ?></li>
					<?php
				}
			}

			if ( $technical_specifications_display ) {
				$technical_specifications = get_post_meta( $car_id, 'technical_specifications', true );
				if ( ! empty( $technical_specifications ) ) {
					?>
					<li data-tabs="tab3"><?php esc_html_e( 'Technical', 'idealauto' ); ?></li>
					<?php
				}
			}

			if ( $general_information_display ) {
				$general_information = get_post_meta( $car_id, 'general_information', true );
				if ( ! empty( $general_information ) ) {
					?>
					<li data-tabs="tab4"><?php esc_html_e( 'General Information', 'idealauto' ); ?></li>
					<?php
				}
			}

			if ( $location_display ) {
				if ( $location_exist ) {
					?>
					<li class="cd-tab-map" data-tabs="tab4"><?php esc_html_e( 'Location', 'idealauto' ); ?></li>
					<?php
				}
			}
			?>
		</ul>
        <div class="jws-group-accordion-wap">
		<?php
		if ( $vehicle_overview_display ) {
			?>
			<div id="tab1" class="tabcontent accordion-active">
                <h3 class="tab-heading"><?php esc_html_e( 'Overview', 'idealauto' ); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
                <div class="cars-Tabs-panel">
				    <?php echo !empty($vehicle_overview) ? do_shortcode( wpautop( $vehicle_overview ) ) : esc_html__('Overview empty.','idealauto'); ?>
                </div>
			</div>
			<?php
		}

		if ( $car_features_options_display && ! empty( $car_features_options )) {
			?>
			<div id="tab2" class="tabcontent">
			        <h3 class="tab-heading"><?php esc_html_e( 'Features & Options', 'idealauto' ); ?><span class="jws-icon-arrow_carrot-down"></span></h3> 
                    <div class="cars-Tabs-panel">
                    
                    
					<?php

                    $html = '';
				
                    
                    $terms = get_the_terms( get_the_ID() , 'car_features_options');
                    $cat_name = array();
                    $terms_check = array();
                    if($terms) {
                        foreach( $terms as $term ) {
                            $terms_check[] = $term->slug;
                            $term = get_term_by("id", $term->parent, "car_features_options");
                     
                            if (isset($term->parent) && $term->parent > 0) {
                                $term = get_term_by("id", $term->parent, "car_features_options");
                                
                            }
                            if (isset($term->term_id)) { 
                              $cat_obj = get_term($term->term_id, 'car_features_options');
                                $cat_name[] = $cat_obj->slug;  
                            }
                            
                            
                        }
                    }

         
          
                    if(!empty($cat_name)) {
                        $cat_name = array_unique($cat_name);
                        $not_child = array();
                        $html .= '<div class="row">';
                        foreach($cat_name as $key => $option) {

                                $category =  get_term_by( 'slug', $option, 'car_features_options' );
             
                                $ids = $category->term_id;
                         
                                $label = $category->name;
                            
                                $childrens = get_categories(
                                  array(
                                    'taxonomy' => 'car_features_options',
                                    'parent' =>$ids,
                                    'hide_empty' => false
                                  )
                                );
                             
                                
                                if ( $ids ) { 
                                    $html.= '<div class="col-xl-4"><h5 class="parent-cat">'.$label.'</h5><ul class="ct_ul_ol features-list">';
                                    foreach( $childrens as $children )
                                    { 
                                        if(in_array($children->slug, $terms_check)) {
                                           $html.= '<li><i class="jws-icon-icon_check"></i>'.esc_html( $children->name ).'</li>'; 
                                        }
                                        
                                    }
                                    $html.= '</ul></div>';
                                }else {
                                    $not_child[] = $option;
                                }
              
            		   } 
              
                            
                       if(isset($not_child[0]) && !empty($not_child)) {

                           $html.= '<div class="col-xl-4"><h5 class="parent-cat">'.esc_html__('Other','idealauto').'</h5><ul class="ct_ul_ol features-list">';
                            foreach( $not_child as $children )
                            { 
                                $html.= '<li><i class="jws-icon-icon_check"></i>'.esc_html( $children ).'</li>';
                            }
                            $html.= '</ul></div>';  
                       } 
                     $html .= '</div>';   
                       
                     
                    }else {
        
                    $options = get_the_terms( get_the_ID() , 'car_features_options');
                    
                      
					$html.= '<ul class="ct_ul_ol list-2 features-list row">';
						  if(!empty($options)) {
    						    foreach ( $options as $option ) {
    							
    								$html.= '<li class="col-xl-4 col-lg-4 col-6"><i class="jws-icon-icon_check"></i>'.esc_html( $option->name ).'</li>';
    							
    							}  
						  }	
					$html.= '</ul>';
				
                    }

                    echo ''.$html;
                    ?>
                    
                
			
			</div>
            </div>
			<?php
		}

		if ( $technical_specifications_display ) {
			?>
			<div id="tab3" class="tabcontent">
                <h3 class="tab-heading"><?php esc_html_e( 'Technical', 'idealauto' ); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
                <div class="cars-Tabs-panel">
				    <?php echo do_shortcode( wpautop( get_post_meta( $car_id, 'technical_specifications', true ) ) ); ?>
                </div>
			</div>
			<?php
		}

		if ( $location_display ) {
			if ( $location_exist ) {

				?>
				<div id="tab4" class="tabcontent">
                    <h3 class="tab-heading"><?php esc_html_e( 'Location', 'idealauto' ); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
                    <div class="cars-Tabs-panel">
					<div class="acf-map">
                           <?php include(JWS_ABS_PATH.'/template-parts/content/cars/single/tabs/map.php'); ?>
					</div>
                    </div>
				</div>
				<?php
			}
		}
		?>
        </div>
	</div>
	<?php
}