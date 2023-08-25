<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $jws_option;
$currency_code = ( isset( $jws_option['cars-currency-symbol'] ) && ! empty( $jws_option['cars-currency-symbol'] ) ) ? $jws_option['cars-currency-symbol'] : '';

if ( function_exists( 'jws_get_currency_symbols' ) ) {
	$currency_symbol = jws_get_currency_symbols( $currency_code );
} else {
	$currency_symbol = '$';
}

?>
<div id="add_car_step5" class="jws-form-row">

    <div class="step-number">
        <span><?php echo esc_html__('Step','idealauto'); ?> 5/5</span><span class="step-text"><?php echo esc_html__('Set your asking price','idealauto'); ?></span>
    </div>
    <div class="section-inner car-price">
        <p><?php echo esc_html__('Determine a competitive price by comparing your vehicle\'s information and mileage to similar vehicles for sale by dealers and private sellers in your area. Then consider pricing your vehicle within range. Be sure to provide Seller\'s Comments and photos to highlight the best features of your vehicle, especially if your asking price is above average.','idealauto'); ?></p>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <?php 		 
		              $value = get_post_meta($id, 'regular_price', true);
                ?>
                <label><?php echo esc_html__('Price','idealauto'); ?> (<?php echo esc_html($currency_symbol); ?>) <abbr>*</abbr></label>
                <input type="number" id="regular_price" name="car_data[regular_price]" value="<?php echo esc_attr($value); ?>" step="0.01" placeholder="<?php echo esc_attr_x( '-- Enter your asking price --', 'placeholder', 'idealauto' ); ?>">
            </div>
            <div class="col-xl-6 col-lg-6">
                <?php 		 
		              $value = get_post_meta($id, 'sale_price', true);
                ?>
                <label><?php echo esc_html__('Sale Price','idealauto'); ?> (<?php echo esc_html($currency_symbol); ?>) </label>
                <input type="number" id="sale_price" name="car_data[sale_price]" value="<?php echo esc_attr($value); ?>" step="0.01" placeholder="<?php echo esc_attr_x( '-- Enter your sale price --', 'placeholder', 'idealauto' ); ?>">
            </div>
        </div>
    </div>
    <div class="step-button">
        <button type="button" class="previous" id="previous4"><i class="jws-icon-arrow-left"></i><?php echo esc_html__('Prev','idealauto'); ?></button>
        <?php
    
    	$label = (!isset($_GET['edit-car']))? esc_html__('Submit', 'idealauto') : esc_html__('Save Change', 'idealauto');?>
    
    	<button type="submit" id="jws-submit-car" class="elementor-button btn-main jws-submit-car"><span><?php echo esc_html($label);?></span></button>
	 </div>
    <div class="jws-notes"></div>
    <?php 
        if( ! isset($user_id) ) { 
            ?>
            <div class="jws-add-car-login">
    	    <form></form>
            <?php jws_get_content_form_login('yes','yes','login'); ?>
            </div>
    	<?php } ?>
</div>
