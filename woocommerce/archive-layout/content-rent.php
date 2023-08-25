<?php
    $seats = get_post_meta( get_the_ID(), '_rental_car_seats', true ); 
    $fuel = get_post_meta( get_the_ID(), '_rental_car_fuel', true );
    $transmission = get_post_meta( get_the_ID(), '_rental_car_transmission', true );
    $doors = get_post_meta( get_the_ID(), '_rental_car_doors', true );
    global $product;
    
    if(isset($_GET['lay_style']) && $_GET['lay_style'] == '1') { ?>
    <div class="product-item-inner list">

   <div class="product-image">
   <?php jws_add_to_wishlist_btn(); ?>
    <?php 
        /**
    	 * Hook: woocommerce_before_shop_loop_item.
    	 *
    	 * @hooked woocommerce_template_loop_product_link_open - 10
    	 */
    	do_action( 'woocommerce_before_shop_loop_item' );
    
    	/**
    	 * Hook: woocommerce_before_shop_loop_item_title.
    	 *
    	 * @hooked woocommerce_show_product_loop_sale_flash - 10
    	 * @hooked woocommerce_template_loop_product_thumbnail - 10
    	 */
    	do_action( 'woocommerce_before_shop_loop_item_title' );
        
    	/**
    	 * Hook: woocommerce_after_shop_loop_item.
    	 *
    	 * @hooked woocommerce_template_loop_product_link_close - 5
    	 * @hooked woocommerce_template_loop_add_to_cart - 10
    	 */
    	do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
    <div class="product-content">
    <?php
    
    /**
    * Hook: woocommerce_shop_loop_item_title.
    *
    * @hooked woocommerce_template_loop_product_title - 10
    */
    do_action( 'woocommerce_shop_loop_item_title' ); 
    woocommerce_template_loop_price();
    
    echo '<div class="raiting-wap">';
    woocommerce_template_loop_rating();
    $orders_ids_array = get_order_ids_by_product(get_the_ID());
    if(!empty($orders_ids_array)) {
       echo '<span class="number-order">('.count($orders_ids_array).esc_html__(' trips','idealauto').')</span>';  
    }
    echo '</div>';

    ?>
            <div class="product-attr">
            <?php if(!empty($seats)) : ?>
                <span class="item">
                    <img class="seat" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/seat.svg">
                    <?php echo esc_attr($seats); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($transmission)) : ?>
                <span class="item">
                    <img class="transmission" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/transmission.svg">
                    <?php echo esc_attr($transmission); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($doors)) : ?>
                <span class="item">
                    <img class="door" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/door.svg">
                    <?php echo esc_attr($doors); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($fuel)) : ?>
                <span class="item">
                    <img class="fuel" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/fuel.svg">
                    <?php echo esc_attr($fuel); ?>
               </span>
            <?php endif; ?>
        </div>
        <a class="view-detail" href="<?php the_permalink(); ?>"><span><?php echo esc_html__('Book Instantly','idealauto'); ?></span></a>
        <a href="#" class="show-detail"><?php echo esc_html__('Features & Price details','idealauto'); ?><i class="arrow_carrot-down"></i></a>
    </div>
    <div class="content-detail">
    <div class="row">
           <div class="col-xl-9 col-12 detail-features"> 
           <label><?php echo esc_html__('Features Details','idealauto'); ?> </label>  
           <?php 
                    global $jws_option;
                    $feature_cat = (isset($jws_option['select_rent_features']) && !empty($jws_option['select_rent_features'])) ? $jws_option['select_rent_features'] : '';
                    if(!empty($feature_cat)) :  
                
                
                    $terms = get_the_terms( get_the_ID(), 'pa_'.$feature_cat );
                  
                    if(!empty($terms)) {
                       
                         foreach ($terms  as $term  ) {
                            $product_cat_id = $term->term_id;
                            $product_cat_name = $term->name;
                            echo '<span>'.$product_cat_name.'</span>';
                        }   
                      
                    }else {
                        echo '<span>'.esc_html__('not found','idealauto').'</span>';
                    }  
                    endif;  
           ?>     
          </div>
        <div class="col-xl-3 col-12 detail-price">

        <label> <?php echo esc_html__('Price Details','idealauto'); ?></label>
        <ul class="ct_ul_ol">
            <li>
                <span class="left"><?php echo esc_html__('1 DAY(S)','idealauto'); ?></span>
                <span class="right"><?php  global $product; if ( $price_html = $product->get_price_html() ) { echo ''.$price_html ;}?></span>
            </li>
            <?php 
                global $product;
                $tax_rates = WC_Tax::get_base_tax_rates( $product->get_tax_class( 'unfiltered' ) ); 
                if(!empty($tax_rates)) :
                $exclu = 0;
                foreach ($tax_rates as $value){
              
                  $exclu +=   (int)$value['rate'] * (int) $product->get_price()  / 100;

               }
   
            ?>
            <li>
                <span class="left open-taxbox"><a href="#tax-box-<?php echo get_the_ID(); ?>"><?php echo esc_html__('TAX & FREE DETAILS','idealauto'); ?></a></span>
                <span class="right"><?php if(get_option( 'woocommerce_tax_display_shop' ) === 'incl') { echo esc_html__('Included*','idealauto'); }else{echo ''.wc_price($exclu); }; ?></span>
            </li>
            <?php endif; ?>
            <li>
                <span class="left"><?php echo esc_html__('TOTAL','idealauto'); ?></span>
                <span class="right"><?php  echo ''.$price = wc_price(  $product->get_price() ) ;  ?></span>
            </li>
        </ul>
        </div>
        <div class="col-12">
            <?php the_excerpt(); ?>
        </div>
        </div>
    </div>

    <?php 
        if(!empty($tax_rates)) { ?>
            <div id="tax-box-<?php echo get_the_ID(); ?>" class="mfp-hide tax-box">
            <div class="tax-top">
                <h3><?php echo esc_html__('TAXES & FEES','idealauto'); ?></h3>
            </div>
                <ul class="ct_ul_ol">
                    <?php 
                         foreach ($tax_rates as $value){
                           ?>
                                <li>
                                    <span class="left"><?php echo ''.$value['label'].'('.$value['rate'].'%'.')'; ?></span>
                                    <span class="right"><?php echo get_option( 'woocommerce_tax_display_shop' ) == 'incl' ? esc_html__('Included*','idealauto') : wc_price($value['rate']*$product->get_price() /100); ?></span>
                                </li>
                           <?php  
                        }
                    ?>
                </ul>
            </div>
        <?php }
        ?>
    
</div>  
<?php }else{
 ?>
<div class="product-item-inner grid">
    <div class="product-image">
    <?php jws_add_to_wishlist_btn(); ?>
    <?php 
        /**
    	 * Hook: woocommerce_before_shop_loop_item.
    	 *
    	 * @hooked woocommerce_template_loop_product_link_open - 10
    	 */
    	do_action( 'woocommerce_before_shop_loop_item' );
    
    	/**
    	 * Hook: woocommerce_before_shop_loop_item_title.
    	 *
    	 * @hooked woocommerce_show_product_loop_sale_flash - 10
    	 * @hooked woocommerce_template_loop_product_thumbnail - 10
    	 */
    	do_action( 'woocommerce_before_shop_loop_item_title' );
        
    	/**
    	 * Hook: woocommerce_after_shop_loop_item.
    	 *
    	 * @hooked woocommerce_template_loop_product_link_close - 5
    	 * @hooked woocommerce_template_loop_add_to_cart - 10
    	 */
    	do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
    <div class="product-content">
    <?php
    
    /**
    * Hook: woocommerce_shop_loop_item_title.
    *
    * @hooked woocommerce_template_loop_product_title - 10
    */
    do_action( 'woocommerce_shop_loop_item_title' );    
    $orders_ids_array = get_order_ids_by_product(get_the_ID());
    //if(!empty($orders_ids_array)) {
       echo '<div class="rent-trips">'; 
       echo  esc_html($product->get_average_rating()); 
       echo '<span class="jws-icon-star-full"></span><span class="number-order">('.count($orders_ids_array).esc_html__(' trips','idealauto').')</span>';  
       echo '</div>'; 
    //}
    
    // We display the orders in a coma separated list

    ?>
            <div class="product-attr">
            <?php if(!empty($seats)) : ?>
                <span class="item">
                    <img class="seat" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/seat.svg">
                    <?php echo esc_attr($seats); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($transmission)) : ?>
                <span class="item">
                    <img class="transmission" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/transmission.svg">
                    <?php echo esc_attr($transmission); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($doors)) : ?>
                <span class="item">
                    <img class="door" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/door.svg">
                    <?php echo esc_attr($doors); ?>
               </span>
            <?php endif; ?>
            <?php if(!empty($fuel)) : ?>
                <span class="item">
                    <img class="fuel" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/rent/fuel.svg">
                    <?php echo esc_attr($fuel); ?>
               </span>
            <?php endif; ?>
        </div>
     <?php   
    woocommerce_template_loop_price();
    ?>
    <a class="view-detail" href="<?php the_permalink(); ?>"><span><?php echo esc_html__('Book Instantly','idealauto'); ?></span><i class="jws-icon-arrow_carrot-right_alt"></i></a>
    </div>
</div>  
<?php }