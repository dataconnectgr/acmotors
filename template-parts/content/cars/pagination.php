<?php
/**
 * Template part to show numbered pagination for catalog pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CarDealer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="jws-pagination-number pagi-ajax">
    <?php jws_cars_pagination(); ?>
</div>
