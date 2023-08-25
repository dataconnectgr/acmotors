<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $jws
?>
<div id="add_car_step4" class="jws-form-row">

    <div class="step-number">
        <span><?php echo esc_html__('Step','idealauto'); ?> 4/5</span><span class="step-text"><?php echo esc_html__('Enter Dealer Note','idealauto'); ?></span>
    </div>
    <div class="section-inner car-dealer-notes">
        <?php 		 
		$value = array();
		$value = get_post_meta($id, 'vehicle_notes', true);?>
	
			<div class="form-group">	
				<?php
               
					// default settings - Kv_front_editor.php
					$content = !empty($value) ? $value : '';
					$editor_id = 'jws-vehicle_notes';
					$settings =   array(
						'wpautop' => true, // use wpautop?
						'media_buttons' => false, // show insert/upload button(s)
						'textarea_name' => 'car_data[vehicle_notes]', // set the textarea name to something different, square brackets [] can be used here
						'textarea_rows' => 6, 
                        'editor_height' => 255, // In pixels, takes precedence and has no default value
						'tabindex' => '',
						'remove_linebreaks' => false,// Don't remove line breaks
						'convert_newlines_to_brs' => true,// Convert newline characters to BR tags
						'editor_css' => '' , //  extra styles for both visual and HTML editors buttons, 
						'editor_class' => 'jws_editor', // add extra class(es) to the editor textarea
						'teeny' => false, // output the minimal editor config used in Press This
						'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
						'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
						'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
					);
					wp_editor( $content, $editor_id, $settings );
				?>
			</div>
	
    </div>
    <div class="step-button">
        <button type="button" class="previous" id="previous3"><i class="jws-icon-arrow-left"></i><?php echo esc_html__('Prev','idealauto'); ?></button>
        <button type="button" class="next" id="next4"><?php echo esc_html__('Next','idealauto'); ?><i class="jws-icon-arrow-right"></i></button>
    </div>
</div>
