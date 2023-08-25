<?php

    global $jws_option;
    
    if ( isset( $jws_option['make_offer_form_status'] ) && ! $jws_option['make_offer_form_status'] ) {
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
    <h3><?php echo esc_html__('Make an Offer','idealauto'); ?></h3>  
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
	<div id="offer-with-dealer">
     <h5 class="per-title"><?php echo esc_html__( 'PERSONAL INFORMATION', 'idealauto' ); ?></h5>    
	<form name="make_an_offer" class="gray-form" method="post" id="make_an_offer_test_form">
		<div class="row">
			<input type="hidden" name="action" class="form-control" value="make_an_offer_action" />
			<?php wp_nonce_field( 'make_an_offer', 'mno_nonce' ); ?>
			<input type="hidden" name="car_id" value="<?php echo esc_attr($id); ?>">
			<div class="col-xl-6">
				<div class="form-group">
					<label for="mao_fname"><?php esc_html_e( 'First Name', 'idealauto' ); ?>*</label>
					<input type="text" name="mao_fname" class="form-control jws_validate" id="mao_fname" maxlength="25"/>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="form-group">
					<label for="mao_lname"><?php esc_html_e( 'Last Name', 'idealauto' ); ?>*</label>
					<input type="text" name="mao_lname" class="form-control jws_validate" id="mao_lname" maxlength="25"/>
				</div>
			</div>
			<div class="col-xl-12">
				<div class="form-group">
					<label for="mao_email"><?php esc_html_e( 'Email', 'idealauto' ); ?>*</label>
					<input type="text" name="mao_email" id="mao_email" class="form-control jws_validate jws_mail" >
				</div>
			</div>
			<div class="col-xl-12">
				<div class="form-group">
					<label for="mao_phone"><?php esc_html_e( 'Home Phone', 'idealauto' ); ?>*</label>
					<input type="text" name="mao_phone" id="mao_phone" class="form-control jws_validate" maxlength="15" >
				</div>
			</div>
			<div class="col-xl-12">
				<div class="form-group">
					<label for="mao_reques_price"><?php esc_html_e( 'Request Price', 'idealauto' ); ?>*</label>
					<input type="text" name="mao_reques_price" id="mao_reques_price" class="form-control jws_validate" maxlength="15" >
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
					<div class="jws-recapcha" id="recap4-<?php echo esc_attr($id); ?>"></div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="form-group btn-form">
					<a class="cancel-form btn-main elementor-button" href=""><?php echo esc_html__('Cancel','idealauto'); ?></a>
					<button id="submit_offer" class="btn-main elementor-button" ><span><?php echo esc_html__( 'Submit', 'idealauto' ); ?></span></button>
			
					<p class="make_an_offer_test_msg" style="display:none;"></p>
				</div>
			</div>
		</div>
	</form>
    </div>
