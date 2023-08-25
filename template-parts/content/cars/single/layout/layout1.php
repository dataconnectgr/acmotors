<?php global $jws_option; ?>
<div class="container">
<div class="cars-single-top row">
    <div class="col-xl-8">
       <h3 class="car-single-title"><?php the_title(); ?></h3>
       <div class="cars-single-top-info row">
        <div class="col-xl-6 col-lg-6 col-12">
               <div class="car-info">
                 <?php 
                    $vin = get_the_terms( get_the_ID(), 'car_vin_number' );
                    $model = get_the_terms( get_the_ID(), 'car_model' );
                    $stock = get_the_terms( get_the_ID(), 'car_stock_number' );
                    if ( ! is_wp_error( $vin ) && isset( $vin[0]->name ) ) {
        				$vin = $vin[0]->name;
                        echo '<span class="car-info-item"><span>'.esc_html__('VIN: ','idealauto').'</span>'.$vin.'</span>';
        			}
                    if ( ! is_wp_error( $model ) && isset( $model[0]->name ) ) {
        				$model = $model[0]->name;
                        echo '<span class="car-info-item"><span>'.esc_html__('Model: ','idealauto').'</span>'.$model.'</span>';
        			}
                    if ( ! is_wp_error( $stock ) && isset( $stock[0]->name ) ) {
        				$stock = $stock[0]->name;
                        echo '<span class="car-info-item"><span>'.esc_html__('Stock: ','idealauto').'</span>'.$stock.'</span>';
        			}
                  ?>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-12">
        <div class="car-form">
                <ul class="ct_ul_ol">
                <?php if(isset($jws_option['req_info_form_status']) && $jws_option['req_info_form_status']) : ?>
                     <li>
                        <a href="#" class="open-modal" data-type="contact" data-car_id="<?php echo get_the_ID(); ?>" data-target="#contact-form"><span><?php esc_html_e('Contact Dealer','idealauto'); ?></span></a>
                         <div class="car-form-popup" id="contact-form">
                            <div class="modal-overlay"></div>
                            <div class="car-form-popup-inner">
                            </div>
                        </div>
                     </li>
                 <?php endif; ?>
                 <?php if(isset($jws_option['schedule_drive_form_status']) && $jws_option['schedule_drive_form_status']) : ?>
                  <li>
                        <a href="#" class="car-test open-modal" data-type="test" data-car_id="<?php echo get_the_ID(); ?>"  data-target="#test-form"><span><?php esc_html_e('Test Drive','idealauto'); ?></span></a>
                        <div class="car-form-popup" id="test-form">
                        <div class="modal-overlay"></div>
                        <div class="car-form-popup-inner">
                        </div>
                    </div>
                    </li>
                    <?php endif; ?>
                    <li>
                        <?php $compare_page = isset($jws_option['select-page-compare']) && !empty($jws_option['select-page-compare']) ? get_permalink($jws_option['select-page-compare']) : '';  ?>
                        <?php $cars_in_compare = isset($_COOKIE['compare_ids']) ? $_COOKIE['compare_ids'] : array(); if(in_array(get_the_ID(), $cars_in_compare)){  $class_added  =  ' added' ; } else { $class_added  =  '' ;  } ?>
                        <?php if(!empty($compare_page)) : ?>
                        <a href="<?php echo ''.$compare_page; ?>" class="car-compare compare_pgs<?php echo esc_attr($class_added); ?>" data-id="<?php echo get_the_ID(); ?>">
                        <span class="added"><?php echo esc_html__('View compare','idealauto'); ?></span>
                        <span class="notadd"><?php echo esc_html__('Add to compare','idealauto'); ?></span>
                        </a>
                        <?php endif; ?>
                    </li>
              </ul>
            
         </div>
        </div>  
       </div>
       	<?php get_template_part( 'template-parts/content/cars/single/car-images' ); ?>
        <?php get_template_part( 'template-parts/content/cars/single/car-attribute' ); ?>
        <?php 
                $dealer_notes = get_post_meta( get_the_ID() , 'vehicle_notes', true );
               
                if(!empty($dealer_notes)) {
                    ?>
                        <div class="cars-single-dealer-notes">
                            <span class="label"><?php echo esc_html__('Dealer Note:','idealauto'); ?></span>
                            <?php  echo esc_html($dealer_notes); ?>
                        </div>
                    <?php
                }
       
        ?>
        <?php get_template_part( 'template-parts/content/cars/single/tabs' ); ?>
    </div>
    <div class="col-xl-4">
        <?php get_template_part( 'template-parts/content/cars/single/sidebar' ); ?>
    </div>
</div>
<?php 
    $car_make  = get_the_terms( get_the_ID(), 'car_make' );

    $related = get_posts( 
    
                array( 
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'car_make',
                            'field' => 'term_id',
                            'terms' => $car_make[0]->term_id,
                        )
                    ),
     
                     'numberposts' => 100,
                     'post_type' => 'cars',
                      'post__not_in' => array(get_the_ID()) ) 
                
                
                );
   
    if(!empty($related)){ ?>
        <div class="cars-related">
             <h3><?php esc_html_e('Similar Vehicles','idealauto'); ?></h3>
             <div class="car-related-slider row" data-slick='{"slidesToShow":4 ,"slidesToScroll": 1, "infinite" : false, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 767,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
                    <?php

                              
                    if( isset($related[0]) ) foreach( $related as $post ) {
                    setup_postdata($post); 
                     ?> 
                    
                            <div class="car-item col-xl-3 slick-slide grid">
                             <?php get_template_part( 'template-parts/content/cars/grid' ); ?>
                             </div>
                            
                    <?php
                    }
                    wp_reset_postdata();
                    
                    ?>
              
               
             </div>
        </div> 
    <?php }
 
if(isset($jws_option['select-content-before-footer-car-single']) && !empty($jws_option['select-content-before-footer-car-single'])) { ?>
    <div class="content-before-footer">
        <?php echo do_shortcode('[hf_template id="'.$jws_option['select-content-before-footer-car-single'].'"]'); ?> 
    </div> 
<?php } ?>
</div>
