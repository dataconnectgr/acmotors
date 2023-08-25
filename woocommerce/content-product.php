<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product , $jws_option;
$layout = (isset($jws_option['shop_layout']) && !empty($jws_option['shop_layout']) ) ? $jws_option['shop_layout'] : 'product';

$columns = (isset($jws_option['shop_columns']) && !empty($jws_option['shop_columns']) ) ? $jws_option['shop_columns'] : '3';


$getlayout   = isset($_GET['lay_style']) ? $_GET['lay_style'] : $columns; 

if($getlayout == '1') {
    $columns = ' col-12';
}
if($getlayout == '4') {
    $columns = ' col-xl-3 col-lg-3 col-12';
}

if($getlayout == '3') {
    $columns = ' col-xl-4 col-lg-4 col-12';
}

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div class="product-item <?php echo esc_attr($layout);echo esc_attr($columns);?>">
    <?php 

    if($layout == 'product') {
         if($getlayout == '1') { 
           wc_get_template_part( 'archive-layout/content-product-list');  
         }else{
           wc_get_template_part( 'archive-layout/content', 'product' ); 
         } 
    }else{
           wc_get_template_part( 'archive-layout/content', 'rent' ); 
    }
   
    
?>
</div>