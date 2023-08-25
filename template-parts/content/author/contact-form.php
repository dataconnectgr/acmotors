<?php

global $jws_option;

$id = '';
if( isset($_GET['id']) ) {
	$id = (int) $_GET['id'];
}  


?>
<div id="contact-with-dealer">
<h5 class="per-title"><?php echo esc_html__( 'Contact Dealer', 'idealauto' ); ?></h5>    
<form  method="post" id="contact-form-<?php echo esc_attr($id); ?>">
	<div class="row">
		<input type="hidden" name="action" class="form-control" value="car_contact_action">
		<input type="hidden" name="car_id" value="<?php echo esc_attr($id); ?>">
        <input type="hidden" name="no-capcha" value="no">
		<?php wp_nonce_field( 'req-info-form', 'rmi_nonce' ); ?>
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
				<label><?php echo esc_html__( 'Mobile', 'idealauto' ); ?></label>
				<input type="text" name="mobile" class="form-control jws_validate"  maxlength="15">
			</div>
        </div>
		<div class="col-xl-12">
            <div class="form-group">
				<label><?php echo esc_html__( 'Your message', 'idealauto' ); ?>*</label>
				<textarea  name="comments" class="form-control" rows="4" maxlength="300"></textarea>
			</div>
		</div>
		<div class="col-xl-12">
			<div class="form-group btn-form">
               <button id="submit_request" class="btn-main elementor-button" ><?php echo esc_html__( 'Send Message', 'idealauto' ); ?></button>
				<span class="spinimg"></span>
				<div class="contact-msg" style="display:none;"></div>
			</div>
		</div>
	</div>
</form>
</div>					