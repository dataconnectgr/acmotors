<?php 

 
$car_images = get_post_meta( get_the_ID() , 'car_images',  true );
$img_car_hover = '';
$img_car = '';
if(!empty($car_images)) {
    $img_car = jws_getImageBySize(array('attach_id' => $car_images[0], 'thumb_size' => 'jws-car-size', 'class' => 'car-images-1 car-images-'.$car_images[0].''));
    $img_car_hover = jws_getImageBySize(array('attach_id' => $car_images[1], 'thumb_size' => 'jws-car-size', 'class' => 'car-images-hover'));
}
?>

<div class="car-inner<?php if(!empty($img_car_hover)) echo ' has-gallery'; ?>">
    <div class="car-image">
        
        <?php  
          
            if(!empty($img_car)) echo ''.$img_car['thumbnail'];
            if(!empty($img_car_hover)) echo ''.$img_car_hover['thumbnail'];
        ?>
        <a class="car-overlay" href="<?php the_permalink(); ?>"></a>
        <?php   jws_inventory_label(); ?>
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
        <div class="car-price-wap">
            <?php jws_car_price_html($class = '', $id = null, $tax_label = false, $echo = true);
                  jws_car_price_msrp_html();
            ?>
        </div>
    </div>
    <div class="car-content">
        <div class="car-content-top">
            <div class="car-content-top-right">
                <?php 
        			$car_status = get_post_meta( get_the_ID() , 'car_status',  true );

    				if ( isset( $car_status ) && 'sold' === $car_status ) {
    					echo '<img class="sold-out-label" src="'.JWS_URI_PATH.'/assets/image/sold_out_label.png" alt="sold-out-label">';
    				}
                ?>
            </div>
            <div class="car-content-top-left">
                 <div class="car-tittle">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </div>
                <div class="car-location">
                  <?php 
                    $long =   get_post_meta( get_the_ID() , 'short_adress',  true );
                  
                        if(!empty($long)) {
                            echo '<i class="fas fa-map-marker-alt"></i>'.$long.''; 
     
                        }
                  ?>
                </div>
            </div>  
        </div>
         <div class="car-content-center">
            <?php 
               jws_get_cars_list_attribute_grid('','');
            ?>
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
                <div class="car-date">
                    <i class="fas fa-calendar"></i><?php echo get_the_date(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 