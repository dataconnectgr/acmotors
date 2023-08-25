<?php
    global $jws_option;
    
    if ( isset( $jws_option['schedule_drive_form_status'] ) && ! $jws_option['schedule_drive_form_status'] ) {
    	return;
    }
    $id = get_the_ID();
    if( isset($_GET['id']) ) {
    	$id = (int) $_GET['id'];
    }  
    $author_id = get_post_field( 'post_author', $id );
    $stock       = get_the_terms( $id , 'car_stock_number' );
    $long = get_post_meta( $id , 'vehicle_location',  true );


    if ( ! is_wp_error( $stock ) && isset( $stock[0]->name ) ) {
    	$car_stock = $stock[0]->name;
    }
?>

<span class="close-modal jws-icon-icon_close"></span>   
    <h3><?php echo esc_html__('Schedule a test drive','idealauto'); ?></h3>  
	<div id="shedule_test_drive">
  <div class="car-info">
        <h4 class="car-name-form"><?php echo get_the_title( $id );?></h4>
        <?php 
        
        echo '<div class="vin-stock color-heading">';
        if(!empty($long)) {
           echo '<span class="dealer-location"><i class="jws-icon-icon_pin"></i>'.$long['address'].'</span>'; 
        }
        if ( ! empty( $car_stock ) ) {
    		echo '<span><span class="attr-text">' .esc_html__('Stock: ','idealauto').'</span>'. esc_html( $car_stock ) . '</span>';
    	}
        echo '</div>';
        ?>
        
            <?php 
                jws_get_cars_list_attribute_grid('yes',$id);
            ?>
       
    </div>
     <h5 class="per-title"><?php echo esc_html__( 'PERSONAL INFORMATION', 'idealauto' ); ?></h5>  
					<?php
					if ( isset( $jws_option['schedule_drive_form'] ) && ! empty( $jws_option['schedule_drive_form'] ) && '1' === (string) $jws_option['schedule_drive_contact_7'] ) {
						echo do_shortcode( $jws_option['schedule_drive_form'] );
					} else {
						?>
						<form method="post" id="schedule_test_form">
							<div class="row">
								<input type="hidden" name="action" class="form-control" value="shedule_test_drive_action">
								<?php wp_nonce_field( 'shedule_test_drive_nonce', 'shedule_test_drive_nonce' ); ?>
								<input type="hidden" name="car_id" value="<?php echo esc_attr($id); ?>">
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'First Name', 'idealauto' ); ?>*</label>
										<input type="text" name="first_name" class="form-control jws_validate" maxlength="25">
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'Last Name', 'idealauto' ); ?>*</label>
										<input type="text" name="last_name" class="form-control jws_validate" maxlength="25">
									</div>
								</div>
                                <div class="col-xl-12">
									<div class="form-group">
										<label><?php echo esc_html__( 'Mobile', 'idealauto' ); ?>*</label>
										<input type="text" name="mobile" class="form-control jws_validate" maxlength="15">
									</div>
								</div>
								<div class="col-xl-12">
									<div class="form-group">
										<label><?php echo esc_html__( 'Email', 'idealauto' ); ?>*</label>
										<input type="text" name="email" class="form-control jws_validate jws_mail" >
									</div>
								</div>
								<div class="col-xl-12">
									<div class="form-group show_test_drive">
										<label><?php echo esc_html__( 'Date', 'idealauto' ); ?>*</label>
										<input autocomplete="off" type="text" name="date" class="form-control date date-time jws_validate" >
                                        <i class="jws-icon-calendar2"></i>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'Preferred Contact', 'idealauto' ); ?></label>
										<div class="radio">
											<label><input style="width:auto" class="check" type="radio" name="preferred_contact" value="email"  checked><?php echo esc_html__( 'Email', 'idealauto' ); ?></label>
										</div>
										<div class="radio">
											<label><input style="width:auto" type="radio" name="preferred_contact" value="phone" ><?php echo esc_html__( 'Phone', 'idealauto' ); ?></label>
										</div>
									</div>
								</div>

								<?php
								if ( function_exists( 'the_privacy_policy_link' ) && isset( $jws_option['schedule_drive_policy_terms'] ) && '1' === (string) $jws_option['schedule_drive_policy_terms'] ) {
									?>
									<div class="col-xl-12 cdhl-terms-privacy-container">
    										<label class="jws-checkbox">
    											<input type="checkbox" name="jws_terms_privacy" class="form-control jws_validate terms" />
    											<?php
    											 echo esc_html( apply_filters( 'cd_contact_privacy_text', esc_html__( 'You agree by submitting this form that you are sending us your data.', 'idealauto' ) ) );
    											?>
    										</label>
    									</div>
									<?php
								}
								?>
								<div class="col-xl-6">
									<div class="form-group">
										<div class="jws-recapcha" id="recap2-<?php echo esc_attr($id); ?>"></div>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group btn-form">
                                        <a class="cancel-form btn-main elementor-button" href=""><?php echo esc_html__('Cancel','idealauto'); ?></a>
					                   <button id="schedule_test_request" car-id="<?php echo esc_attr($id); ?>" class="btn-main elementor-button" ><span><?php echo esc_html__( 'Request', 'idealauto' ); ?></span></button>
										<span class="spinimg"></span>
										<p class="schedule_test_msg" style="display:none;"></p>
									</div>
								</div>
							</div>
						</form>
						<?php
					}
					?>
				</div>

<script>
   jQuery(document).ready(function ($) {
        var jwsToday = new Date();
        var dateTimeFormat = jws_obj.datetimeformat;

        
               jQuery('.date-time').datetimepicker({ 
                format: dateTimeFormat,
                defaultDate: jwsToday,
                defaultSelect: false,
                closeOnDateSelect: false,
                timeHeightInTimePicker: 40,
                validateOnBlur: false,
                fixed: false,
            }); 
   });     
</script>