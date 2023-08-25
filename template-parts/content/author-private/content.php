<?php 
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
wp_enqueue_style('lightgallery'); 
wp_enqueue_script('lightgallery-all');
$user = wp_get_current_user();
 global $wp , $jws_option;
// Get all the user roles as an array.
 $user_roles = $user->roles;
$user_rol = esc_html__('Private Seller','idealauto');
 if ( in_array( 'private_seller', $user_roles, true ) ) {
    $user_rol = esc_html__('Private Seller','idealauto');
}elseif(in_array( 'business_seller', $user_roles, true ) ) {
    $user_rol = esc_html__('Business Seller','idealauto');
}
?>

 <div class="row dealer-private">
    <div class="col-xl-4 col-lg-12 col-12"> 
      <div class="dealer-side-wap jws_sticky_move"> 
      <div class="dealer-images"> 
      <?php 
            $jws_user_avatar = get_user_meta( $user->ID, 'dealer-avatar', true );
			if ( isset( $jws_user_avatar ) && ! empty( $jws_user_avatar ) ) {
			     $img = jws_getImageBySize(array('attach_id' => $jws_user_avatar, 'thumb_size' => 'thumbnail', 'class' => 'dealer-image'));
                 echo ''.$img['thumbnail'];
			}else{
			     echo '<img class="dealer-image" src="'.get_template_directory_uri() . '/assets/image/image-default.png" width="122" height="122" alt="car-image-default" title="car-image-default">';
			} 
            ?>
            <div>
             <h2 class="dealer-name"><?php echo jws_display_user_name($author); ?></h2>
             <span><?php echo ''.$user_rol; ?></span>
             <?php if (!empty($ratings['average'])): ?>
                <div class="jws-star-rating">
                    <div class="inner">
                        <div class="jws-star-rating-upper"
                             style="width:<?php echo esc_attr($ratings['average_width']); ?>"></div>
                        <div class="jws-star-rating-lower"></div>
                    </div>
                    <span class="rating-count"><?php echo esc_attr($ratings['average']); ?> (<?php echo esc_html($ratings['count']).esc_html__(' reviews','idealauto'); ?>)</span>
                    <a href="#tabs-nav" class="write-review" data-tabs="tab3"> <?php echo esc_html__('Write a review','idealauto'); ?> </a>
                </div>
            <?php endif; ?>
            </div>
      </div>
      
      <div class="navigation-user">
        <ul class="ct_ul_ol">
            <li><a class="<?php if(count($wp->query_vars) < 2) echo esc_attr('active'); ?>" href="<?php echo get_author_posts_url( $author ); ?>"><i class="jws-icon-004-car"></i><?php echo esc_html__('My Inventory','idealauto'); ?></a></li>
            <li><a class="<?php if(isset($wp->query_vars['edit-profile'])) echo esc_attr('active'); ?>" href="<?php echo get_author_posts_url( $author ); ?>edit-profile"><i class="jws-icon-002-settings"></i><?php echo esc_html__('Profile setting','idealauto'); ?></a></li>
            <li><a class="<?php if(isset($wp->query_vars['favorites'])) echo esc_attr('active'); ?>" href="<?php echo get_author_posts_url( $author ); ?>favorites"><i class="jws-icon-icon_heart_alt"></i><?php echo esc_html__('Wishlist ','idealauto'); ?></a></li>
        </ul>
      </div>

  <?php 
        $long = get_the_author_meta('dealer_location',$author);
        $phone = get_the_author_meta('dealer_phone',$author);
        $mail = get_the_author_meta('email',$author);  
   ?>
  <ul class="ct_ul_ol contact-info">
    <?php if(!empty($long)) : ?>
    <li class="address"><i class="fas fa-map-marker-alt"></i><span><span><?php echo esc_html__('ADDRESS','idealauto'); ?></span><?php echo esc_html($long['address']); ?></span></li>
    <?php endif; ?>
    <?php if(!empty($phone)) : ?>
    <li class="phone"><i class="fas fa-phone-alt"></i><span><span><?php echo esc_html__('Seller Contact phone','idealauto'); ?></span><p><?php echo esc_html($phone); ?></p></span></li>
    <?php endif; ?>
    <?php if(!empty($mail)) : ?>
    <li class="mail"><i class="jws-icon-icon_mail_alt"></i><span><span><?php echo esc_html__('Seller email','idealauto'); ?></span><?php echo esc_html($mail); ?></span></li>
    <?php endif; ?>
  </ul>
  
  <div class="dealer-plane">
    <?php 
        	if ( is_user_logged_in() ) {
					
					$pricing_page = ( isset( $jws_option['select-pricing-page'] ) && ! empty( $jws_option['select-pricing-page'] ) ) ? get_permalink( $jws_option['select-pricing-page'] ) : '';

					if ( class_exists( 'Subscriptio' ) || class_exists( 'RP_SUB' ) ) {
						$user               = wp_get_current_user();
						$user_id            = intval( $user->ID );
						$user_subscriptions = array();

						if ( function_exists( 'subscriptio_get_customer_subscriptions' ) ) {
							$user_subscriptions = subscriptio_get_customer_subscriptions( $user_id );
						}

						$_product_id        = '';
						$status             = false; // phpcs:ignore WordPress.WP.GlobalVariablesOverride

						if ( ! empty( $user_subscriptions ) ) {

							$user_subscription = reset( $user_subscriptions );

							$status   = $user_subscription->get_status(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
							$id       = $user_subscription->get_id(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
							$items    = $user_subscription->get_items();
                            if($status == 'active') {
                               $datetime = $user_subscription->calculate_next_renewal_payment_datetime(); 
                            }else{
                               $datetime = ''; 
                            }
                            
							$datetime = gmdate( 'd-m-Y', strtotime( $datetime ) );

							foreach ( $items as $item ) {
								$_product_id = $item->get_product_id();
							}
							$_product_title = get_the_title( $_product_id );
						}

						if ( 'active' === $status ) {
							echo '<div class="has-plan"><i class="jws-icon-wallet2"></i><span><span> ' . esc_html__( 'Current Plan', 'idealauto' ) . '</span> <strong> ' . $_product_title . ' </strong></span></div>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotE
							echo '<div><i class="jws-icon-calendar2"></i><span> ' . esc_html__( 'Subscription Renewal', 'idealauto' ) . '</span> <strong> ' . $datetime . ' </strong></div>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotE

							if ( ! empty( $pricing_page ) ) {
								echo '<div><a class="elementor-button btn-main" href="' . esc_url( $pricing_page ) . '">' . esc_html__( 'Get New Plan', 'idealauto' ) . '</a></div>';
							}
						}elseif('pending' === $status) {
						    echo '<div><i class="jws-icon-wallet2"></i><span><span> ' . esc_html__( 'Current Plan', 'idealauto' ) . '</span> <strong> ' . esc_html__( 'PENDING', 'idealauto' ) . ' </strong></span></div>';
							if ( ! empty( $pricing_page ) ) {
								echo '<div><a class="elementor-button btn-main" href="' . esc_url( $pricing_page ) . '">' . esc_html__( 'Upgrade plan', 'idealauto' ) . '</a></div>';
							}
						}
                        else {
							echo '<div><i class="jws-icon-wallet2"></i><span><span> ' . esc_html__( 'Current Plan', 'idealauto' ) . '</span> <strong> ' . esc_html__( 'FREE', 'idealauto' ) . ' </strong></span></div>';
							if ( ! empty( $pricing_page ) ) {
								echo '<div><a class="elementor-button btn-main" href="' . esc_url( $pricing_page ) . '">' . esc_html__( 'Upgrade plan', 'idealauto' ) . '</a></div>';
							}
						}
					}
				}
    ?>
  </div>

</div> 
        </div>
    
        <div class="col-xl-8 col-lg-12 col-12 dealer-sidebar">
            <?php 
               
            
                if(isset($wp->query_vars['favorites'])) {
                   get_template_part( 'template-parts/content/author-private/favorites' ); 
                }elseif(isset($wp->query_vars['edit-profile'])) {
                   get_template_part( 'template-parts/content/author-private/edit-profile' );  
                }elseif(isset($wp->query_vars['edit-woo-address'])) {
                   wc_get_template_part( 'myaccount/my-address' );  
                }else{
                   get_template_part( 'template-parts/content/author-private/my-cars' );    
                }
          
              ?>
        </div>
    </div>
