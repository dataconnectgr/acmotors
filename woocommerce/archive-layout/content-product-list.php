<div class="product-item-inner list row row-eq-height">
    <div class="col-left col-xl-3 col-lg-3">
         <div class="product-image">
            <a href="<?php the_permalink(); ?>" class="overlay"></a>
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
               <div class="buttton-inner">
                    <?php jws_button_product_grid(); ?>
               </div>
        </div>
    </div>
    <div class="col-center col-xl-6 col-lg-6">
        	<?php
                echo '<div class="car-brand">'.get_the_term_list( $post->ID, 'product_brand', '', ', ' ).'</div>';
                /**
            	 * Hook: woocommerce_shop_loop_item_title.
            	 *
            	 * @hooked woocommerce_template_loop_product_title - 10
            	 */
                 
            	do_action( 'woocommerce_shop_loop_item_title' );
                woocommerce_template_loop_rating();
                if(has_excerpt()) {
                   echo '<div class="product-description">'; 
                    the_excerpt(); 
                   echo '</div>'; 
                }

                $stock_status = get_post_meta( get_the_ID(), '_stock_status', true );
            
                  if ( 'instock' == $stock_status) {        
                        echo '<p class="stock in-stock">'.esc_html__('In stock','idealauto').'</p>';  
                  } else {
                        echo '<p class="stock out-of-stock">'.esc_html__('Out of stock','idealauto').'</p>';      
                  }
                
               
        	?>
    </div>
    <div class="col-right col-xl-3 col-lg-3">
        <?php  woocommerce_template_loop_price(); ?>
        <div class="product-buy">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>
  </div>  