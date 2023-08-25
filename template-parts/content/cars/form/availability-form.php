<?php

    global $jws_option;
    
    if ( isset( $jws_option['avai_info_form_status'] ) && ! $jws_option['avai_info_form_status'] ) {
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
     <h3><?php echo esc_html__('Check Availability','idealauto'); ?></h3>  
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
	<div id="avaite-with-dealer">
                    <h5 class="per-title"><?php echo esc_html__( 'PERSONAL INFORMATION', 'idealauto' ); ?></h5>
					<?php
					if ( isset( $jws_option['avai_info_form'] ) && ! empty( $jws_option['avai_info_form'] ) && '1' === (string) $jws_option['avai_info_contact_7'] ) {
						echo do_shortcode( $jws_option['avai_info_form'] );
					} else {
						?>
						<form  method="post" id="avaite-form-<?php echo esc_attr($id); ?>">
							<div class="row">
								<input type="hidden" name="action" class="form-control" value="car_avaite_action">
								<input type="hidden" name="car_id" value="<?php echo esc_attr($id); ?>">
								<?php wp_nonce_field( 'avai-nonce', 'avai-nonce' ); ?>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'First Name', 'idealauto' ); ?>*</label>
										<input type="text" name="first_name" class="form-control jws_validate" avaiuired maxlength="25">
									</div>
								</div>
								<div class="col-xl-6">
									<div class="form-group">
										<label><?php echo esc_html__( 'Last Name', 'idealauto' ); ?>*</label>
										<input type="text" name="last_name" class="form-control jws_validate" avaiuired maxlength="25">
									</div>
								</div>
                                <div class="col-xl-12">
                                    	<div class="form-group">
										<label><?php echo esc_html__( 'Phone number', 'idealauto' ); ?>*</label>
										<input type="text" name="mobile" class="form-control jws_validate"  maxlength="15">
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
										<label><?php echo esc_html__( 'Message Text', 'idealauto' ); ?></label>
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
										<div class="jws-recapcha" id="recap5-<?php echo esc_attr($id); ?>"></div>
									</div>
								</div>
						
								<div class="col-xl-6">
									<div class="form-group btn-form">
                                        <a class="cancel-form btn-main elementor-button" href=""><?php echo esc_html__('Cancel','idealauto'); ?></a>
										<button id="submit_avaiuest" class="btn-main elementor-button" ><span><?php echo esc_html__( 'Submit', 'idealauto' ); ?></span></button>
										<div class="avaite-msg" style="display:none;"></div>
									</div>
								</div>
							</div>
						</form>
						<?php
					}
					?>
				</div>
