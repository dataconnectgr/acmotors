<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $jws_option;
$getlayout = (isset($jws_option['shop_columns']) && !empty($jws_option['shop_columns']) ) ? $jws_option['shop_columns'] : '3';

$list_view_layout = array(
    '4',
    '3',
	'1',
);

if(isset($_GET['lay_style']) && !empty($_GET['lay_style'])) {
   $getlayout =  $_GET['lay_style'];
}else {
   $getlayout = $getlayout;
}
$layout_css_style = array();
foreach ( $list_view_layout as $key => $value ) {
	$layout_css_style[ $key ] = ( $getlayout  === $value ) ? "sel-active" : '';
}
global $wp;

 
if ( '' === get_option( 'permalink_structure' ) ) {
	$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
} else {
	$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
}

?>
<div class="shop-top-filters-right">
    <div class="woo-ordering">
    <form class="woocommerce-ordering" method="get" action="<?php echo esc_url( $form_action ); ?>">
        <span><?php echo esc_html__('Sort by','idealauto'); ?></span>
    	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'idealauto' ); ?>">
    		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
    			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
    		<?php endforeach; ?>
    	</select>
    	<input type="hidden" name="paged" value="1" />
    	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
    </form>
    </div>
    <?php if(isset($jws_option['columns_review'])) : ?>
	<div class="grid-view change-view-button">
	<div class="view-icon">
        <?php if($jws_option['columns_review']['4'] == '1') : ?>
        <a class="view-product-grid2 <?php echo esc_attr( $layout_css_style[0] ); ?>" data-id="4" href="<?php echo add_query_arg('lay_style', '4', jws_shop_page_link(true)); ?>">
        <span>
            <i class="jws-icon-layout-grid4-01"></i>
        </span>
        </a>
        <?php endif; ?>
        <?php if($jws_option['columns_review']['3'] == '1') : ?>
		<a class="view-product-3 <?php echo esc_attr( $layout_css_style[1] ); ?>" data-id="3" href="<?php echo add_query_arg('lay_style', '3', jws_shop_page_link(true)); ?>">
        <span>
            <i class="jws-icon-004-grid"></i>
        </span>
        </a>
        <?php endif; ?>
        <?php if($jws_option['columns_review']['1'] == '1') : ?>
        <a class="view-product-1 <?php echo esc_attr( $layout_css_style[2] ); ?>" data-id="1" href="<?php echo add_query_arg('lay_style', '1', jws_shop_page_link(true)); ?>">
        <span>
            <i class="jws-icon-005-list"></i>
        </span>
        </a>
        <?php endif; ?>
	</div>
	</div><!--.grid-view-->
    <?php endif; ?>
</div>
</div>