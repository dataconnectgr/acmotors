<?php 
    $car_images = get_post_meta( get_the_ID() , 'car_images',  true );
    $img_car_hover = '';
    $img_car = '';
    if(!empty($car_images)) {
        $img_car = jws_getImageBySize(array('attach_id' => $car_images[0], 'thumb_size' => 'jws-car-list-size', 'class' => 'car-images-1 car-images-'.$car_images[0].''));
        $img_car_hover = (isset($car_images[1])) ? jws_getImageBySize(array('attach_id' => $car_images[1], 'thumb_size' => 'jws-car-list-size', 'class' => 'car-images-hover')) : '';
    }
?>
<div class="car-inner row row-eq-height<?php if(!empty($img_car_hover)) echo ' has-gallery'; ?>">
    <div class="car-inner-left">
    <div class="car-image">
         <?php  
          
            if(!empty($img_car)) echo ''.$img_car['thumbnail'];
            if(!empty($img_car_hover)) echo ''.$img_car_hover['thumbnail'];
        ?>
        <a class="car-overlay" href="<?php the_permalink(); ?>"></a>
        <?php  jws_inventory_label(); ?>
          <div class="car-action-wap">
            <?php 
                if(empty($_COOKIE['compare_ids'])) {
                	$_COOKIE['compare_ids'] = array();
                }
                $cars_in_compare = $_COOKIE['compare_ids'];
                global $jws_option;
                
                $compare_page = isset($jws_option['select-page-compare']) && !empty($jws_option['select-page-compare']) ? get_permalink($jws_option['select-page-compare']) : ''; 
                
                
            ?>
            	<?php
                if(!empty($compare_page)) { 
                 if(in_array(get_the_ID(), $cars_in_compare)){  $class_added  =  ' added' ; } else { $class_added  =  '' ;  } ?>
                    <a href="<?php echo esc_url($compare_page); ?>" class="car-compare compare_pgs<?php echo esc_attr($class_added); ?>" data-id="<?php echo get_the_ID(); ?>">
                        <i class="jws-icon-009-shuffle"></i>
                        <span class="added"><?php echo esc_html__('View compare','idealauto'); ?></span>
                        <span class="notadd"><?php echo esc_html__('Add to compare','idealauto'); ?></span>
                    </a>
                    
                <?php  } ?>    
                <?php $images = jws_get_images_url( 'car_catalog_image', $id ); ?> 
                <?php if(!empty($images)) {
                  echo  '<a href="#" class="car-gallery" href="" data-links="'.implode( ', ', $images ).'"><i class="jws-icon-art"></i><span>'.esc_html__('View Gallery','idealauto').'</span></a>';   
                }    
               ?>
        </div>
    </div>
    </div>
    <div class="car-inner-right">
    <div class="car-content">
        <div class="car-content-top">
            <div class="car-content-top-right">
                <div class="car-price-wap">
                    <?php 
                        $car_status = get_post_meta( get_the_ID() , 'car_status',  true );
    
        				if ( isset( $car_status ) && 'sold' === $car_status ) {
        					echo '<img class="sold-out-label" src="'.JWS_URI_PATH.'/assets/image/sold_out_label.png" alt="sold-out-label">';
        				}
            			else{
            			    jws_car_price_html($class = '', $id = null, $tax_label = false, $echo = true);
            			}
                        jws_car_price_msrp_html();
                    ?>
                </div>
            </div>
            <div class="car-content-top-left">
                 <div class="car-tittle">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
                <div class="car-location">
                    <?php

                        $long = get_post_meta( get_the_ID() , 'vehicle_location',  true );
                   
                        if(!empty($long)) {
                             echo '<i class="fas fa-map-marker-alt"></i>'.$long['address'].''; 

                        }
                    ?>
                   
                </div>
            </div>  
        </div>
         <div class="car-content-center">
            <?php 
                jws_get_cars_list_attribute_grid('yes','');
            ?>
        </div>
         <div class="car-content-center-two">
            <?php 
                jws_get_vehicle_review_stamps(get_the_ID());
            ?>
            <div class="dealer-info">
                <?php 
                    $author_id = get_post_field( 'post_author', get_the_ID() );
                    $author_badge = get_the_author_meta('dealer-avatar',$author_id);
                    if($author_badge) {
                      $img = jws_getImageBySize(array('attach_id' => $author_badge, 'thumb_size' => 'thumbnail', 'class' => 'dealer-images'));  
                    }
                ?>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                <?php if(isset($img)) echo ''.$img['thumbnail']; ?>
                <span class="author-name"><?php echo get_the_author_meta('display_name'); ?></span>
                <div class="jws-star-rating">
                    <?php $ratings = jws_get_dealer_marks($author_id);  dealer_review_html($ratings); ?>
                </div>
                </a>
            </div>
        </div>
        <div class="car-content-bottom">
            <div class="car-content-bottom-left">
                 <span class="car-share">
                   <span class="car-share-btn"><i class="jws-icon-008-share"></i></span>
                   <div class="car-share-popup">
                        <a target="_blank" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');"><span class="fab fa-facebook-f"></span></a>
                
                		<a target="_blank" href="http://twitter.com/share?url=<?php the_permalink(); ?>"><span class="fab fa-twitter"></span></a>

                
                		<a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"><i class="fab fa-pinterest-p"></i></a>       
                    </div>
                 </span>
                </div>
            <div class="car-content-bottom-right">
                <div class="car-form">
                    <ul class="ct_ul_ol">
                        <li>
                            <a href="<?php the_permalink(); ?>" class="car-detail"><?php esc_html_e('Vehicle Detail','idealauto'); ?></a>
                        </li><li>
                            <a href="#" class="open-modal" data-type="contact" data-car_id="<?php echo get_the_ID(); ?>" data-target="#contact-form-<?php echo get_the_ID(); ?>"><span><?php esc_html_e('Contact Dealer','idealauto'); ?></span></a>
                             <div class="car-form-popup" id="contact-form-<?php echo get_the_ID(); ?>">
                                <div class="modal-overlay"></div>
                                <div class="car-form-popup-inner">
                                </div>
                            </div>
                        </li><li>
                            <a href="#" class="car-test open-modal" data-type="test" data-car_id="<?php echo get_the_ID(); ?>"  data-target="#test-form-<?php echo get_the_ID(); ?>"><span><?php esc_html_e('Test Drive','idealauto'); ?></span></a>
                            <div class="car-form-popup" id="test-form-<?php echo get_the_ID(); ?>">
                            <div class="modal-overlay"></div>
                            <div class="car-form-popup-inner">
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
 