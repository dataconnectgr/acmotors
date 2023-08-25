<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $jws_option;
?>
<div id="add_car_step3" class="jws-form-row">
    <div class="step-number">
        <span><?php echo esc_html__('Step','idealauto'); ?> 3/5</span><span class="step-text"><?php echo esc_html__('Additional Information','idealauto'); ?></span>
    </div>
    <?php
        $car_fields = jws_get_car_form_fields();
    ?>
    <?php if(isset($jws_option['car_sub_features']) && $jws_option['car_sub_features']) : ?>
      <div class="section-inner add-car-fearture">
        <h4 class="section-title"><?php echo esc_html__('EXTRA FEATURES & OPTION','idealauto'); ?></h4>
            <div class="row">
               	<?php
                    $value = array();    
                    if(!empty($id)) {
                       $taxObj = wp_get_post_terms($id, 'car_features_options');
    					foreach( $taxObj as $obj ){
    						$value[] = $obj->slug;
    					} 
                    }
                    $value2 = get_post_meta($id, 'car_features_options', true);
            
                    $html = '';
					$options =  get_terms( array(
                        'taxonomy' => 'car_features_options',
                        'hide_empty' => false,
                        'parent' => 0
                    ) );
          
                    if(!empty($options)) {
        
                        $not_child = array();
                        foreach($options as $key => $option) {
                      
                                $category = get_term_by( 'slug', $option->slug, 'car_features_options' );
            
                                $ids = $category->term_id;
                                $label = $category->name;
                            
                                $childrens = get_categories(
                                  array(
                                    'taxonomy' => 'car_features_options',
                                    'parent' =>$ids,
                                    'hide_empty' => false
                                  )
                                );
                             
                                
                                if ( $childrens ) { 
                                    $html.= '<div class="col-xl-4 col-lg-4"><h5 class="parent-cat">'.$label.'</h5><ul class="ct_ul_ol features-list">';
                                    foreach( $childrens as $children )
                                    { 
                                      
                                        $cheched= '';
                        				if( is_array( $value ) ){
                        					if( in_array( $children->slug, $value ) ){
                        						$cheched= 'checked';
                        					}
                        				}  
                                        
                                      $html.= '<li><label class="jws-checkbox">
        								<input
        									id="jws-'.esc_attr( $children->slug ).'"
        									type="checkbox"
        									class="form-control jws-'.esc_attr( $children->slug ).' jws-checkbox"
        									name="car_data[car_features_options][]"
        									value="'.esc_attr( $children->slug ).'"
        									'.esc_attr($cheched).'
        								/>
        								<span>'.$children->name.'</span>
        							</label><li>';
                                    }
                                    $html.= '</ul></div>';
                                }else {
                                    $not_child[] = (object) array('slug' => $option->slug,'name' => $option->name);
                                  
                                }
              
            		   } 
                        if(!empty($not_child)) {
                         
                           $html.= '<div class="col-xl-4 col-lg-4"><h5 class="parent-cat">'.esc_html__('Other','idealauto').'</h5><ul class="ct_ul_ol features-list">';
                            foreach( $not_child as $children )
                            { 
                          
                                
                                
                                
                            $html.= '<li><label class="jws-checkbox">
								<input
									id="jws-'.esc_attr( $children->slug ).'"
									type="checkbox"
									class="form-control jws-'.esc_attr( $children->slug ).' jws-checkbox"
									name="car_data[car_features_options][]"
									value="'.esc_attr( $children->slug ).'"
									'.esc_attr($cheched).'
								/>
								<span>'.$children->name.'</span>
							</label><li>';
                                
                            }
                            $html.= '</ul></div>';
                           
                        } 
                     
                    }else {
                        
                    $options =  get_terms( array(
                        'taxonomy' => 'car_features_options',
                        'hide_empty' => false,
                    ) );
                      
					$html.= '<ul class="ct_ul_ol list-2 features-list row">';
						
							foreach ( $options as $option ) {
							
								$html.= '<li class="col-xl-4 col-lg-4 col-6"><i class="jws-icon-icon_check"></i>'.esc_html( $option->name ).'</li>';
							
							}
						
					$html.= '</ul>';
                 
				    
                    }

                    echo ''.$html;
                
                ?>
            </div>
        </div>
        <?php endif; ?>
        <?php if(isset($jws_option['car_sub_overview']) && $jws_option['car_sub_overview']) : ?>
        <div class="section-inner car-overview">
        <h4 class="section-title"><?php echo esc_html__('VEHICLE OVERVIEW','idealauto'); ?></h4>
          <?php 		 
			$value = array();
			$value = get_post_meta($id, 'vehicle_overview', true);?>
			
				<div class="form-group">	
					<?php
                   
						// default settings - Kv_front_editor.php
						$content = !empty($value) ? $value : '';
						$editor_id = 'jws-vehicle_overview';
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false, // show insert/upload button(s)
							'textarea_name' => 'car_data[vehicle_overview]', // set the textarea name to something different, square brackets [] can be used here
							'textarea_rows' => 6, 
                            'editor_height' => 255, // In pixels, takes precedence and has no default value
							'tabindex' => '',
							'remove_linebreaks' => false,// Don't remove line breaks
							'convert_newlines_to_brs' => true,// Convert newline characters to BR tags
							'editor_css' => '' , //  extra styles for both visual and HTML editors buttons, 
							'editor_class' => 'jws_editor', // add extra class(es) to the editor textarea
							'teeny' => false, // output the minimal editor config used in Press This
							'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
							'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
							'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
						);
						wp_editor( $content, $editor_id, $settings );
					?>
				</div>
		
			<?php		
    	 ?>
        </div>
        <?php endif; ?>
         <?php if(isset($jws_option['car_sub_specifications']) && $jws_option['car_sub_specifications']) : ?>
        <div class="section-inner car-technical-specifications">
        <h4 class="section-title"><?php echo esc_html__('TECHNICAL SPECIFICATIONS','idealauto'); ?></h4>
          <?php 		 
			$value = array();
			$value = get_post_meta($id, 'technical_specifications', true);?>
		
				<div class="form-group">	
					<?php
                   
						// default settings - Kv_front_editor.php
						$content = !empty($value) ? $value : '';
						$editor_id = 'jws-technical_specifications';
						$settings =   array(
							'wpautop' => true, // use wpautop?
							'media_buttons' => false, // show insert/upload button(s)
							'textarea_name' => 'car_data[technical_specifications]', // set the textarea name to something different, square brackets [] can be used here
							'textarea_rows' => 6, 
                            'editor_height' => 255, // In pixels, takes precedence and has no default value
							'tabindex' => '',
							'remove_linebreaks' => false,// Don't remove line breaks
							'convert_newlines_to_brs' => true,// Convert newline characters to BR tags
							'editor_css' => '' , //  extra styles for both visual and HTML editors buttons, 
							'editor_class' => 'jws_editor', // add extra class(es) to the editor textarea
							'teeny' => false, // output the minimal editor config used in Press This
							'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
							'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
							'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
						);
						wp_editor( $content, $editor_id, $settings );
					?>
				</div>
				
			<?php		
    	 ?>
        </div>
        <?php endif; ?>
    <div class="step-button">
        <button type="button" class="previous" id="previous2"><i class="jws-icon-arrow-left"></i><?php echo esc_html__('Prev','idealauto'); ?></button>
        <button type="button" class="next" id="next3"><?php echo esc_html__('Next','idealauto'); ?><i class="jws-icon-arrow-right"></i></button>
    </div>
</div>
