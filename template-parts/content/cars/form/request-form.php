<?php

global $jws_option;

if ( isset( $jws_option['req_info_form_status'] ) && ! $jws_option['req_info_form_status'] ) {
	return;
}
$id = get_the_ID();
if( isset($_GET['id']) ) {
	$id = (int) $_GET['id'];
}  
?>

  <span class="close-modal jws-icon-icon_close"></span>   
                        <h3><?php echo esc_html__('Complete Reservation','idealauto'); ?></h3>  
	<div id="request-with-dealer">
                 
                         <div class="car-info">
                            <h4 class="car-name-form"><?php echo get_the_title( $id );?></h4>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="car-info-item location-up">
                                        <label><span class="jws-icon-icon_pin"></span><?php echo esc_html__('Pick-up location','idealauto'); ?></label>
                                        <p>
                                           
                                        </p>
                                    </div>
                                    <div class="car-info-item location-end">
                                        <label><span class="jws-icon-icon_pin"></span><?php echo esc_html__('Return location','idealauto'); ?></label>
                                        <p>
                                        </p>
                                    </div>   
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <div class="car-info-item date-up">
                                        <label><span class="jws-icon-calendar2"></span><?php echo esc_html__('Pick-up date & time','idealauto'); ?></label>
                                        <p>
                                        </p>
                                    </div> 
                                    <div class="car-info-item date-end">
                                        <label><span class="jws-icon-calendar2"></span><?php echo esc_html__('Return date & time','idealauto'); ?></label>
                                        <p>
                                        </p>
                                    </div> 
                                </div>
                            </div>
                            <?php 
                            $long = get_post_meta( get_the_ID() , 'short_adress',  true );
                            if(!empty($long)) {
                               echo '<span class="dealer-location"><i class="jws-icon-icon_pin"></i>'.$long.'</span>'; 
                            }
                            echo '<div class="vin-stock color-heading">';
                            if ( ! empty( $car_vin ) ) {
                        		echo '<span><span class="attr-text">' .esc_html__('VIN: ','idealauto').'</span>'. esc_html( $car_vin ) . '</span>';
                        	}
                            if ( ! empty( $car_stock ) ) {
                        		echo '<span><span class="attr-text">' .esc_html__('Stock: ','idealauto').'</span>'. esc_html( $car_stock ) . '</span>';
                        	}
                            echo '</div>';
                            ?>
                        </div>
         
                        <h5 class="per-title"><?php echo esc_html__( 'PERSONAL INFORMATION', 'idealauto' ); ?></h5>    
						<form  method="post" id="request-form-<?php echo esc_attr($id); ?>">
							<div class="row">
								<input type="hidden" name="action" class="form-control" value="car_request_action">
								<input type="hidden" name="car_id" value="<?php echo esc_attr($id); ?>">
								<?php wp_nonce_field( 'rque_nonce', 'rque_nonce' ); ?>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'First Name', 'idealauto' ); ?>*</label>
										<input type="text" name="first_name" class="form-control jws_validate" required maxlength="25">
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'Last Name', 'idealauto' ); ?>*</label>
										<input type="text" name="last_name" class="form-control jws_validate" required maxlength="25">
									</div>
								</div>
                                <div class="col-xl-12">
                                    <div class="form-group">
										<label><?php echo esc_html__( 'Email', 'idealauto' ); ?>*</label>
										<input type="text" name="email" class="form-control jws_validate jws_mail" maxlength="50">
									</div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-group">
										<label><?php echo esc_html__( 'Mobile', 'idealauto' ); ?>*</label>
										<input type="text" name="mobile" class="form-control jws_validate"  maxlength="15">
									</div>
                                </div>
                                <div class="col-xl-6">	
									<div class="form-group">
										<label><?php echo esc_html__( 'Preferred Contact', 'idealauto' ); ?></label>
										<div class="radio">
											<label class="jws-checkbox"><input style="width:auto;" type="radio" name="contact" value="email" checked="checked"><span class="checkmark"></span><?php echo esc_html__( 'Email', 'idealauto' ); ?></label>
										</div>
										<div class="radio">
											<label class="jws-checkbox"><input style="width:auto;" type="radio" name="contact" value="phone"><span class="checkmark"></span><?php echo esc_html__( 'Phone', 'idealauto' ); ?></label>
										</div>
									</div>
								</div>
								<div class="col-xl-12">
                                    <div class="form-group">
										<label><?php echo esc_html__( 'Your message', 'idealauto' ); ?></label>
										<textarea  name="comments" class="form-control" rows="4" maxlength="300"></textarea>
									</div>
								</div>
					           	
								<?php
								if ( function_exists( 'the_privacy_policy_link' ) && isset( $jws_option['req_info_policy_terms'] ) && '1' === (string) $jws_option['req_info_policy_terms'] ) {
									?>
									<div class="col-xl-12 cdhl-terms-privacy-container">
    										<label class="jws-checkbox">
    											<input type="checkbox" name="jws_terms_privacy" class="form-control jws_validate terms" />
                                                <span class="checkmark"></span>
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
					                   <button id="rent_request" class="btn-main elementor-button" ><span><?php echo esc_html__( 'Submit', 'idealauto' ); ?></span></button>
										<span class="spinimg"></span>
										<div class="contact-msg" style="display:none;"></div>
									</div>
								</div>
							</div>
						</form>
                     
						<?php
				
					?>
				</div>