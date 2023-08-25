<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $jws_option;
if(isset($_GET['full']) && $_GET['full'] == 'full-width') { 
  $fullwidth = (isset($_GET['full']) && $_GET['full']) ? $_GET['full'] : false; 
}else {
  $fullwidth = (isset($jws_option['shop-fullwidth-switch']) && $jws_option['shop-fullwidth-switch']) ? $jws_option['shop-fullwidth-switch'] : false;  
}

if(isset($_GET['layout']) && $_GET['layout']) { 
  $position = $_GET['layout'];  
}else{
  $position = (isset($jws_option['shop_position_sidebar']) && $jws_option['shop_position_sidebar']) ? $jws_option['shop_position_sidebar'] : 'no_sidebar';  
}


if($position == 'no_sidebar') {
   $content_col = 'shop-content col-12'; 
   $sidebar_col = 'shop-sidebar sidebar_sticky ';
   $class = ' no_sidebar';
}else {
   $content_col = 'shop-content col-xl-9 col-lg-12 col-12';
   $sidebar_col = 'shop-sidebar col-xl-3 col-lg-12 col-12'; 
   $class = ' has_sidebar'; 
}
get_header( 'shop' );
wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
wp_enqueue_script('magnificPopup');
wp_enqueue_style('magnificPopup');
?>
<div class="shop-page">
<?php 
    if ( is_active_sidebar( 'sidebar-shop2' ) ) { ?>
      <div class="shop-sidebar-top">
        
            <?php dynamic_sidebar( 'sidebar-shop2' ); ?>
         
      </div>
    <?php } 
?>
<div class="shop-container<?php echo ''.($fullwidth) ? ' no_container' : ' container'; ?>">
    <div class="row">
         <?php if($position == 'left') { ?>
            <div class="<?php echo esc_attr($sidebar_col); ?>">
                <div class="jws_sticky_move">
                    <div class="siderbar-inner">
                        <?php
                            if ( is_active_sidebar( 'sidebar-shop' ) ) {
                                    dynamic_sidebar( 'sidebar-shop' );
                            } 
                        ?>
                    </div>
                    
                    <?php
                        if ( is_active_sidebar( 'sidebar-shop-banner' ) ) {
                            echo '<div class="shop-banner">';
                                dynamic_sidebar( 'sidebar-shop-banner' );
                            echo '</div>';    
                        } 
                    ?>
                   
                </div>
            </div>
        <?php } ?>
        <div class="<?php echo esc_attr($content_col);  ?>">
        <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action( 'woocommerce_before_main_content' );
        
        if ( woocommerce_product_loop() ) {

        	/**
        	 * Hook: woocommerce_before_shop_loop.
        	 *
        	 * @hooked woocommerce_output_all_notices - 10
        	 * @hooked woocommerce_result_count - 20
        	 * @hooked woocommerce_catalog_ordering - 30
        	 */
        	do_action( 'woocommerce_before_shop_loop' );
        
        	woocommerce_product_loop_start();
   
        	if ( wc_get_loop_prop( 'total' ) ) {
        		while ( have_posts() ) {
        			the_post();
            
        			/**
        			 * Hook: woocommerce_shop_loop.
        			 */
        			do_action( 'woocommerce_shop_loop' );
        
        			wc_get_template_part( 'content', 'product' );
        		}
        	}
        
        	woocommerce_product_loop_end();
        
        	/**
        	 * Hook: woocommerce_after_shop_loop.
        	 *
        	 * @hooked woocommerce_pagination - 10
        	 */
        	do_action( 'woocommerce_after_shop_loop' );
        } else {
        	/**
        	 * Hook: woocommerce_no_products_found.
        	 *
        	 * @hooked wc_no_products_found - 10
        	 */
        	do_action( 'woocommerce_no_products_found' );
        }
        
        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
        ?>
        </div>
        <?php if($position == 'right') { ?>
            <div class="<?php echo esc_attr($sidebar_col); ?>">
                <div class="siderbar-inner">
                    <?php
                        if ( is_active_sidebar( 'sidebar-shop' ) ) {
                                dynamic_sidebar( 'sidebar-shop' );
                        } 
                    ?>
                </div>
                <div class="shop-banner">
                    <?php
                        if ( is_active_sidebar( 'sidebar-shop-banner' ) ) {
                                dynamic_sidebar( 'sidebar-shop-banner' );
                        } 
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php 
    if(isset($jws_option['select-content-before-footer-shop-page']) && !empty($jws_option['select-content-before-footer-shop-page'])) { ?>
        <div class="content-before-footer">
            <?php echo do_shortcode('[hf_template id="'.$jws_option['select-content-before-footer-shop-page'].'"]'); ?> 
        </div> 
    <?php } ?>
</div>
</div>
<?php   
get_footer( 'shop' );