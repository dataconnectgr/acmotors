<?php 

global $jws_option;
    
    
$layout = (isset($jws_option['cars-detail-layout'])) ? $jws_option['cars-detail-layout'] : 'layout1';

if(isset($_GET['car_layout']) && $_GET['car_layout'] == 'layout2') {
     $layout =  'layout2';
}
 $car_id = get_the_ID(); 
if($layout == 'layout1') { ?>
    <div class="car-single-images">
        
        <div class="images-wap">
        <?php  jws_inventory_label(); ?>
            <?php
                
                    $video_link = get_post_meta( $car_id , 'video_link',  true );
                    echo (!empty($video_link)) ? '<div class="car-video-popup-wap"><a href="'.esc_url($video_link).'" class="car-video-popup"> <i class="jws-icon-play"></i>'.esc_html__('Watch video','idealauto').'</a></div>' : '';
                
            ?>
            <div class="jws-car-favorite" data-id="<?php echo get_the_ID(); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr__('Add to favorites','idealauto'); ?>">
    			<i class="jws-icon-icon_heart_alt"></i>
    		</div>
            <div class="images-slider">
                <?php
                    
            			$car_images = get_post_meta( $car_id , 'car_images', true );
   
            			$url        = array();
            			if ( ! empty( $car_images ) ) {
            				foreach ( $car_images as $car_image ) {
                                $img = jws_getImageBySize(array('attach_id' => $car_image, 'thumb_size' => 'jws-car-single-size', 'class' => 'attachment-large wp-post-image'));
                                $imagefull = wp_get_attachment_image_src($car_image, 'full');
                                echo '<div class="slider-item slick-slide" data-src="'.$imagefull[0].'">'.$img['thumbnail'].'</div>';
            				}
            			}
            	
                ?>
            </div>
        </div>
        <div class="thumbnail-slider">
            <?php
               
        			$car_images = get_post_meta( $car_id , 'car_images',  true );
        			$url        = array();
        			if ( ! empty( $car_images ) ) {
        				foreach ( $car_images as $car_image ) {
                            $img = jws_getImageBySize(array('attach_id' => $car_image, 'thumb_size' => 'jws-car-single-size', 'class' => 'attachment-large wp-post-image'));
                            echo '<div class="slider-item slick-slide">'.$img['thumbnail'].'</div>';
        				}
        			}
        	
            ?>
        </div>
    </div>
<?php } else { ?>
     <div class="car-single-images">
        <div class="images-wap">
            <?php
               
                    $video_link = get_post_meta( $car_id , 'video_link',  true );
                    echo (!empty($video_link)) ? '<div class="car-video-popup-wap"><a href="'.esc_url($video_link).'" class="car-video-popup"> <i class="jws-icon-play"></i>'.esc_html__('Watch video','idealauto').'</a></div>' : '';
               
            ?>
            <div class="jws-car-favorite" data-id="<?php echo get_the_ID(); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr__('Add to favorites','idealauto'); ?>">
    			<i class="jws-icon-icon_heart_alt"></i>
    		</div>
            <div class="images-slider" data-slick='{"slidesToShow":3 ,"slidesToScroll": 1, "infinite" : false, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 767,"settings":{"slidesToShow": 2}},{"breakpoint": 530,"settings":{"slidesToShow": 1}}]}'>
                <?php
                    
            			$car_images = get_post_meta( $car_id , 'car_images',  true );
            			$url        = array();
            			if ( ! empty( $car_images ) ) {
            				foreach ( $car_images as $car_image ) {
                                $img = jws_getImageBySize(array('attach_id' => $car_image, 'thumb_size' => 'jws-car-single-size2', 'class' => 'attachment-large wp-post-image'));
                                $imagefull = wp_get_attachment_image_src($car_image, 'full');
                                echo '<div class="slider-item col-xl-4 col-lg-6 col-12 slick-slide" data-src="'.$imagefull[0].'">'.$img['thumbnail'].'</div>';
            				}
            			}
            		
                ?>
            </div>
        </div>
    </div>
<?php }
