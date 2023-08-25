<?php 
    $user = wp_get_current_user();
    $user_id = $user->ID;
    global $jws_option;
    $features =  get_post_meta( get_the_ID() , 'car_asset_type',  true );
    $car_images = get_post_meta( get_the_ID() , 'car_images',  true );
    $img_car_hover = '';
    $img_car = '';
    if(!empty($car_images)) {
        $img_car = jws_getImageBySize(array('attach_id' => $car_images[0], 'thumb_size' => 'jws-car-list-size', 'class' => 'car-images-1 car-images-'.$car_images[0].''));
        $img_car_hover = (isset($car_images[1])) ? jws_getImageBySize(array('attach_id' => $car_images[1], 'thumb_size' => 'jws-car-list-size', 'class' => 'car-images-hover')) : '';
    }
?>
<div class="car-inner row row-eq-height<?php if(get_post_status ( get_the_ID() ) == 'pending' || get_post_status ( get_the_ID() ) == 'draft') echo esc_attr(' pending-draft');if(!empty($img_car_hover)) echo ' has-gallery';  ?>">
    <div class="car-inner-left">
    <div class="car-image">
        
        <?php  
           $car_images =  get_post_meta( get_the_ID() , 'car_images',  true );
           if(!empty($car_images)) {
            echo ''.$img_car['thumbnail'];
           }else{
			     echo '<img class="car-image-default" src="'.get_template_directory_uri() . '/assets/image/image-default.png" width="408" height="235" alt="car-image-default" title="car-image-default">';
			} 
            if(!empty($img_car_hover)) echo ''.$img_car_hover['thumbnail'];
        ?>
        <a class="car-overlay" href="<?php the_permalink(); ?>"></a>
        
                <?php if(get_post_status ( get_the_ID() ) == 'pending')  : ?>
                        <h4><?php esc_html_e('Pending . . .', 'idealauto'); ?></h4>   
                <?php endif; ?>
                <?php if(get_post_status ( get_the_ID() ) == 'draft')  : ?>
                        <h4><?php esc_html_e('Disabled', 'idealauto'); ?></h4>   
                <?php endif; ?>
                <?php if(get_post_status ( get_the_ID() ) == 'public')  : ?>
                        <a title="<?php esc_attr_e('Make features','idealauto'); ?>" href="javascript:void(0)" data-id="<?php echo get_the_ID(); ?>" class="jws-make-features<?php echo (isset($features) && $features == 'featured') ? ' active' : ''; ?>"><i class="jws-icon-star-full"></i></a>        
                <?php endif; ?>   
        
        <div class="car-action-wap">
           
                
                <?php if(get_post_status ( get_the_ID() ) != 'pending')  : ?>
                    <a href="<?php if(isset($jws_option['select-page-submit']) && !empty($jws_option['select-page-submit'])) echo get_page_link($jws_option['select-page-submit']); ?>?edit-car=<?php echo esc_attr($user_id); ?>&car-id=<?php echo get_the_ID(); ?>" class="edit-cars">
                        <i class="fas fa-pencil-alt"></i>
                        <span><?php esc_html_e('Edit Inventory','idealauto'); ?></span>
                    </a>
                
                
                    <?php if(get_post_status(get_the_ID()) == 'draft'): ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>?jws_car_action=enable&id=<?php echo get_the_ID(); ?>" class="enable-cars">
                        <i class="fas fa-eye"></i>
                        <span><?php esc_html_e('Enable Inventory','idealauto'); ?></span>
                    </a>  
                    <?php else: ?>          
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>?jws_car_action=disable&id=<?php echo get_the_ID(); ?>" class="disable-cars">
                       <i class="fas fa-eye-slash"></i>
                       <span><?php esc_html_e('Disable Inventory','idealauto'); ?></span>
                    </a>  
                    
                    <?php endif; ?>
                      <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>?jws_car_action=trash&id=<?php echo get_the_ID(); ?>" data-title="<?php the_title(); ?>" class="remove-cars">
                       <i class="fas fa-trash-alt"></i>
                       <span><?php esc_html_e('Trash Inventory','idealauto'); ?></span>
                    </a>
                    
                       
                <?php else: ?>    
                    
                    <a href="<?php echo get_permalink($jws_option['select-page-submit']); ?>?edit-car=<?php echo esc_attr($user_id); ?>&car-id=<?php echo get_the_ID(); ?>" class="edit-cars">
                        <i class="fas fa-pencil-alt"></i>
                        <span><?php esc_html_e('Edit Inventory','idealauto'); ?></span>
                    </a>    
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>?jws_car_action=trash&id=<?php echo get_the_ID(); ?>" data-title="<?php the_title(); ?>" class="remove-cars">
                       <i class="fas fa-trash-alt"></i>
                       <span><?php esc_html_e('Trash Inventory','idealauto'); ?></span>
                    </a>
                    
                <?php endif; ?>
            
        </div>

    </div>
    </div>
    <div class="car-inner-right">
    <div class="car-content">
        <div class="car-content-top">
            <div class="car-content-top-right">
                <div class="car-price-wap">
                    <?php jws_car_price_html();
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

                        $long =  get_post_meta( get_the_ID() , 'vehicle_location',  true );
                   
                        if(isset($long['address']) && !empty($long['address'])) {
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
                
                		<a target="_blank" href="http://plus.google.com/share?url=<?php the_permalink(); ?>"><span class="fab fa-google-plus-g"></span></a>
                
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
 