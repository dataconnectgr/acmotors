  <div class="product-item-inner deal">
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
            woocommerce_template_loop_price();
            ?>
    </div>
	<?php
    echo '<div class="car-brand">'.get_the_term_list( $post->ID, 'product_brand', '', ', ' ).'</div>';
    /**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
     
	do_action( 'woocommerce_shop_loop_item_title' );
	$countdown_time = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
    if(!empty($countdown_time)) { ?>
       <div class="idealautoduct-sale-time" data-d="<?php echo esc_attr__('DAYS','idealauto'); ?>" data-h="<?php echo esc_attr__('HOURS','idealauto'); ?>" data-m="<?php echo esc_attr__('MINS','idealauto'); ?>" data-s="<?php echo esc_attr__('SEC','idealauto'); ?>" data-countdown="<?php echo strtotime($countdown_time); ?>"></div> 
    <?php }?>
    <?php
       
          global $product;
          $units_sold = get_post_meta( $product->get_id(), 'total_sales', true );
          $total = $product->get_stock_quantity();
          if(!empty($units_sold) && !empty($total)) {
            $result = ($units_sold / $total) * 100;
            echo '<div class="progress-bar-sold">
                    <span class="sold_count"><span>'.esc_html__('Order:','idealauto').'</span><strong>'.$units_sold.'</strong></span>
                    <span class="available_items"><span>'.esc_html__('Available Items:','idealauto').'</span><strong>'.$total.'</strong></span>
                    <p class="line"><span style="width:'.$result.'%"></span></p>
                 </div>';
          }
        
    ?>
  </div>  