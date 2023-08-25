<?php global $jws_option; $author_id = get_post_field( 'post_author', get_the_ID() ); ?>
<div class="car-single-sidebar">
    <div class="section1 section">
        <div class="car-single-price">
            <div class="car-single-price-top">
                        <?php 
                              jws_car_price_html();  
                              jws_car_price_msrp_html();
                              
                        ?>
            </div>
            <div class="clear-both"></div>
            <div class="car-single-price-bottom">
                <?php jws_get_vehicle_review_stamps(get_the_ID()); ?>
            </div>
            
        </div>
    </div>
    <?php 
       if(jws_theme_get_option('enable_sidebar_dealer_info_single')) :
    ?>
    <div class="section2 section">
         <div class="dealer-info">
              
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                <?php
                        $jws_user_avatar = get_user_meta( $author_id, 'dealer-avatar', true );
                        
            			if ( isset( $jws_user_avatar ) && ! empty( $jws_user_avatar ) ) {
            			     $img = jws_getImageBySize(array('attach_id' => $jws_user_avatar, 'thumb_size' => 'thumbnail', 'class' => 'dealer-image'));
                             echo ''.$img['thumbnail'];
            			} 
                 ?>
                <span class="info">
                    <span class="dealer-name"><?php echo get_the_author_meta('display_name'); ?></span>
                    <div class="jws-star-rating">
                        <?php $ratings = jws_get_dealer_marks($author_id); dealer_review_html($ratings); ?>
                    </div>
                    <?php
       
                        $long = get_the_author_meta('dealer_location',$author_id);
 
                        if(!empty($long)) {
                           echo '<span class="dealer-location"><i class="fas fa-map-marker-alt"></i>'.$long['address'].'</span>'; 
                        }
                     
                    
                     ?>
                </span>
                </a>
            </div>
    </div>
    <?php 
       endif;
    ?>
    <?php 
       if(jws_theme_get_option('enable_sidebar_phone_single')) :
    ?>
    <div class="section3 section">
        <?php  $phone = get_the_author_meta('dealer_phone',$author_id);  if(!empty($phone)) : ?>
        <div class="dealer-phone">
            <i class="jws-icon-icon_phone"></i>
            <span>
                    <?php
                      
                           echo '<span class="dealer-title">'.esc_html__('Contact Dealer','idealauto').'</span>' ;
                           echo '<span class="dealer-phone-number">'.$phone.'</span>'; 
                        
                    ?>
            </span>
        </div>
        <?php endif; ?>
        <ul class="ct_ul_ol dealer-social">
            <?php
                $facebook = get_the_author_meta('dealer_facebook',$author_id);
                $twitter = get_the_author_meta('dealer_twitter',$author_id);
                $whatsapp = get_the_author_meta('dealer_whatsapp',$author_id);
                $instagram = get_the_author_meta('dealer_instagram',$author_id);
                if(!empty($facebook)) echo '<li><a href="'.esc_url($facebook).'"><i class="fab fa-facebook-f"></i></a></li>';
                if(!empty($twitter)) echo '<li><a href="'.esc_url($twitter).'"><i class="fab fa-twitter"></i></a></li>';
                if(!empty($whatsapp)) echo '<li><a href="'.esc_url($whatsapp).'"><i class="fab fa-whatsapp"></i></a></li>';
                if(!empty($instagram)) echo '<li><a href="'.esc_url($instagram).'"><i class="fab fa-instagram"></i></a></li>';
             ?>
        </ul>
    </div>
    <?php 
       endif;
    ?>
   
    <div class="section4 section">
        <?php 
           if(jws_theme_get_option('enable_sidebar_finance_single')) :
        ?>
        <?php get_template_part( 'template-parts/content/cars/single/sidebar/finance-lease-tabs' ); ?>
        <?php 
            endif;
        ?>
        <ul class="ct_ul_ol">
            <?php if(isset($jws_option['quo_info_form_status']) && $jws_option['quo_info_form_status']) : ?>
            <li>
            <a class="open-modal" href="#" data-type="quote" data-car_id="<?php echo get_the_ID(); ?>" data-target="#quote-form"><span><?php echo esc_html__('Get a Quote','idealauto'); ?></span></a>
                <div class="car-form-popup" id="quote-form">
                    <div class="modal-overlay"></div>
                    <div class="car-form-popup-inner">
                
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <?php if(isset($jws_option['make_offer_form_status']) && $jws_option['make_offer_form_status']) : ?>
            <li>
            <a class="open-modal" href="#" data-type="offer" data-car_id="<?php echo get_the_ID(); ?>" data-target="#offer-form"><span><?php echo esc_html__('Make an Offer','idealauto'); ?></span></a>
                <div class="car-form-popup" id="offer-form">
                    <div class="modal-overlay"></div>
                    <div class="car-form-popup-inner">
      
                    </div>
                </div>
            </li>
            <?php endif; ?>
            <?php if(isset($jws_option['avai_info_form_status']) && $jws_option['avai_info_form_status']) : ?>
            <li>
            <a class="open-modal" href="#" data-type="availability" data-car_id="<?php echo get_the_ID(); ?>" data-target="#availability-form"><span><?php echo esc_html__('Confirm Availability','idealauto'); ?></span></a>
                    <div class="car-form-popup" id="availability-form">
                    <div class="modal-overlay"></div>
                    <div class="car-form-popup-inner">
               
                    </div>
                </div>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    
    <div class="section5 section">
        <ul class="ct_ul_ol">
            <li>
                <a class="share-cars" href="javascript:void(0)">
                    <span class="jws-icon-008-share"></span>
                    <?php echo esc_html__('Share this car','idealauto'); ?>
                </a>
                <div class="cars-share addthis_inline_share_toolbox">
                    <div class="cars-share-inner">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook"></i></a>
            
            		<a target="_blank" href="//plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fab fa-google"></i></a>
            
            		<a  target="_blank" href="//twitter.com/share?url=<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>

                    <a  target="_blank" href="//www.linkedin.com/shareArticle?mini=true&title=<?php echo get_the_title(); ?>&url=<?php  the_permalink(); ?>"><i class="fab fa-linkedin"></i></a>
                    
                    </div>
                </div>
            </li>
            <li>
                <a class="print-cars-page" href="javascript:void(0)">
                    <span class="jws-icon-ink"></span>
                    <?php echo esc_html__('Print Summary','idealauto'); ?>
                </a>
            </li>
            <?php 
                $sticker = get_post_meta(get_the_ID(), 'window_sticker_file', true); 
                if(!empty($sticker)) {
                
                ?>
                <li>
                    <a target="_blank" href="<?php echo wp_get_attachment_url($sticker); ?>">
                        <span class="jws-icon-document"></span>
                        <?php echo esc_html__('Window Sticker','idealauto'); ?>
                    </a>
                </li>
                <?php
                }
            ?>
            
        </ul>
        <script type='text/javascript'>
 
        jQuery(function($) { 'use strict';
            $('.print-cars-page').click(function(){
                $(".car-single-title, .car-info, .car-single-images, .car-single-attribute, .car-single-tabs").printThis({
                    loadCSS: "<?php echo JWS_URI_PATH. '/assets/css/less/print.less'; ?>",  
                    importStyle: true,  
                });
            });
           
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });
 
        </script>
    </div>
</div>