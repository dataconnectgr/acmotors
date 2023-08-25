<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_script('jws-edit-profile');
$user = get_userdata( $author );

?>

<form id="jws-edit-account-form" class="jws-edit-account-form edit-account" action="" method="post" enctype="multipart/form-data">


	<div class="details edit-row">
		<h3><?php esc_html_e( 'Personal details', 'idealauto' ); ?></h3>
        <div class="row">
    
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="account_first_name"><?php esc_html_e( 'First name', 'idealauto' ); ?> <span class="required">*</span></label>
    			<input type="text" class="jws-Input jws-Input-text input-text jws_validate" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
    		</div>
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="account_last_name"><?php esc_html_e( 'Last name', 'idealauto' ); ?> <span class="required">*</span></label>
    			<input type="text" class="jws-Input jws-Input-text input-text jws_validate" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
    		</div>
        </div>
        <div class="form-row">
			<label for="account_email"><?php esc_html_e( 'Display name publicly', 'idealauto' ); ?> <span class="required">*</span></label>
			<input type="text" class="jws-Input jws-Input-text input-text jws_validate" name="account_name_publicly" id="account_name_publicly" value="<?php echo jws_display_user_name($author); ?>" />
		</div>
		<div class="form-row">
			<label for="account_email"><?php esc_html_e( 'Email address', 'idealauto' ); ?> <span class="required">*</span></label>
			<input type="email" class="jws-Input jws-Input-email input-text jws_validate" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</div>
        <div class="form-row">
			<label for="account_phone"><?php esc_html_e( 'Phone', 'idealauto' ); ?> <span class="required">*</span></label>
			<input type="tel" class="jws-Input jws-Input-phone input-text jws_validate" name="account_phone" id="account_phone" value="<?php echo esc_attr( get_user_meta( $user->ID, 'dealer_phone', true ) ); ?>" />
		</div>
         <div class="form-row">
            <div class="upload-file">
            <input id="file_attachments_avatar" name="file_attachments_avatar" type="hidden" class="form-control file_attachments_avatar">
			<input type="file" id="profile-img" name="profile_img" class="form-control user_picked_files" accept="image/png, image/svg, image/jpeg" />
            <a class="elementor-button btn-main" href="#"><?php echo esc_html__('Profile Avatar Upload','idealauto'); ?><span class="fas fa-cloud-upload-alt"></span></a>
	        	</div>   
				<div class="jws_uploaded_files">
                    <?php
    					$jws_user_avatar = get_user_meta( $user->ID, 'dealer-avatar', true );
                        $image = wp_get_attachment_image_src($jws_user_avatar, 'full');
                      
                      
    				?>
                    <?php 
                        if(!empty($image)) { ?>
                           <div class="jws-item" data-media = "<?php echo intval($jws_user_avatar); ?>" style="background-image: url(<?php echo esc_attr($image[0]); ?>);">
            				    <i class="remove jws-icon-icon_close" data-media="<?php echo intval($jws_user_avatar); ?>" data-id="0"></i>	
                           </div> 
                        <?php }
                    ?>
                    
                    <?php 
                        if(!empty($image)) { ?>
                         <script type="text/javascript">
                            var user_avatar_loaded = [
                                <?php 
                                    echo intval($jws_user_avatar);
                                ?>
                            ]
                        </script>
                        <? }
                    ?>
				</div>
		</div>
       
	</div>
    <div class="dealer-gallery edit-row">
          <h3><?php esc_html_e( 'Gallery', 'idealauto' ); ?></h3>  
          <div class="form-row">
            <?php get_template_part( 'template-parts/content/author-private/profile-gallery' );  ?>
         </div>   
    </div>
	<div class="password edit-row">
		<h3><?php esc_html_e( 'Password change', 'idealauto' ); ?></h3>

		<div class="form-row">
			<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'idealauto' ); ?></label>
			<input type="password" class="jws-Input jws-Input-password input-text" name="password_current" id="password_current" />
		</div>
		<div class="form-row">
			<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'idealauto' ); ?></label>
			<input type="password" class="jws-Input jws-Input-password input-text" name="password_1" id="password_1" />
		</div>
		<div class="form-row">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'idealauto' ); ?></label>
			<input type="password" class="jws-Input jws-Input-password input-text" name="password_2" id="password_2" />
		</div>
	</div>
    <div class="user-map edit-row">
		<h3><?php esc_html_e( 'User Address', 'idealauto' ); ?></h3>
        <?php get_template_part( 'template-parts/content/author-private/user-map' );  ?>
    </div>    
	<div class="social edit-row">
		<h3><?php esc_html_e( 'Social Profiles', 'idealauto' ); ?></h3>
        <div class="row">
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="user_facebook"><?php esc_html_e( 'Facebook', 'idealauto' ); ?></label>
    			<input type="text" class="jws-Input jws-Input-facebook input-text" name="user_facebook" id="user_facebook" value="<?php echo esc_attr( get_user_meta( $user->ID, 'dealer_facebook', true ) ); ?>" />
    		</div>
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="user_twitter"><?php esc_html_e( 'Twitter', 'idealauto' ); ?></label>
    			<input type="text" class="jws-Input jws-Input-twitter input-text" name="user_twitter" id="user_twitter" value="<?php echo esc_attr( get_user_meta( $user->ID, 'dealer_twitter', true ) ); ?>"/>
    		</div>
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="user_whatsapp"><?php esc_html_e( 'LinkedIn', 'idealauto' ); ?></label>
    			<input type="text" class="jws-Input jws-Input-linkedIn input-text" name="user_whatsapp" id="user_whatsapp" value="<?php echo esc_attr( get_user_meta( $user->ID, 'dealer_whatsapp', true ) ); ?>"/>
    		</div>
    		<div class="form-row col-xl-6 col-lg-6 col-12">
    			<label for="user_instagram"><?php esc_html_e( 'Instagram', 'idealauto' ); ?></label>
    			<input type="text" class="jws-Input jws-Input-instagram input-text" name="user_instagram" id="dealer_instagram" value="<?php echo esc_attr( get_user_meta( $user->ID, 'dealer_instagram', true ) ); ?>"/>
    		</div>
        </div>
	</div>
    
    <div class="opentime edit-row">
		<h3><?php esc_html_e( 'Open Time', 'idealauto' ); ?></h3>
        <?php 
            $opentime = array(
                'monday' => esc_html__('Monday','idealauto'),
                'tuesday' => esc_html__('Tuesday','idealauto'),
                'wednesday' => esc_html__('Wednesday','idealauto'),
                'thursday' => esc_html__('Thursday','idealauto'),
                'friday' => esc_html__('Friday','idealauto'),
                'saturday' => esc_html__('Saturday','idealauto'),
                'sunday' => esc_html__('Sunday','idealauto'),
            )
        ?>
        <div class="row">
    		<?php 
                foreach($opentime as $key => $value) {
                    ?>
                        <div class="form-row col-xl-6 col-lg-6 col-12">
                			<label for="<?php echo esc_attr('open_'.$key); ?>"><?php echo esc_html($value); ?></label>
                			<input type="text" class="input-text" name="<?php echo esc_attr($key); ?>" id="<?php echo esc_attr('open_'.$key); ?>" value="<?php echo esc_attr( get_user_meta( $user->ID, $key , true ) ); ?>" />
                		</div>
                    <?php
                }
            ?>
        </div>
	</div>
    	<div class="banner edit-row">
		<h3><?php esc_html_e( 'Banner Profiles', 'idealauto' ); ?></h3>
        <div class="row">
                <div class="form-row col-12">
    			<label for="banner_url"><?php esc_html_e( 'Url', 'idealauto' ); ?></label>
    			<input type="text" class="input-text" name="banner_url" id="banner_url" value="<?php echo esc_attr( get_user_meta( $user->ID, 'banner_url', true ) ); ?>" />
    		</div>
               <div class="form-row col-12">
                <div class="upload-file">
                <input id="file_attachments_banner" name="file_attachments_banner" type="hidden" class="form-control file_attachments_banner">
    			<input type="file" id="profile-banner" name="profile_banner" class="form-control user_picked_files" accept="image/png, image/svg, image/jpeg" />
                <a class="elementor-button btn-main" href="#"><?php echo esc_html__('Banner Upload','idealauto'); ?><span class="fas fa-cloud-upload-alt"></span></a>
    	        	</div>   
    				<div class="jws_uploaded_files">
                        <?php
        					$jws_user_avatar = get_user_meta( $user->ID, 'banner', true );
                            $image = wp_get_attachment_image_src($jws_user_avatar, 'full');
                          
                          
        				?>
                        <?php 
                            if(!empty($image)) { ?>
                               <div class="jws-item" data-media = "<?php echo intval($jws_user_avatar); ?>" style="background-image: url(<?php echo esc_attr($image[0]); ?>);">
                				    <i class="remove jws-icon-icon_close" data-media="<?php echo intval($jws_user_avatar); ?>" data-id="0"></i>	
                               </div> 
                            <?php }
                        ?>
                        
                        <?php 
                            if(!empty($image)) { ?>
                             <script type="text/javascript">
                                var user_banner_loaded = [
                                    <?php 
                                        echo intval($jws_user_avatar);
                                    ?>
                                ]
                            </script>
                            <? }
                        ?>
    				</div>
    		</div>
    		
        </div>
	</div>
    <div class="type edit-row">
        <h3><?php esc_html_e( 'Type', 'idealauto' ); ?></h3>
        <div class="form-group">	
        <?php 
             $user_roles = $user->roles;
             $check1 = $check2 = '';
    	     $user_rol = '';  
             if ( in_array( 'private_seller', $user_roles, true ) ) {
                $check1 = ' checked="checked"';
            }elseif(in_array( 'business_seller', $user_roles, true ) ) {
                $check2 = ' checked="checked"';
            }
        ?>       										
		<label class="jws-checkbox">
			<input name="user_type" value="private_seller" type="radio"<?php echo esc_attr($check1); ?>>
            <span class="checkmark"></span>
            <span><?php echo esc_html__('Private seller','idealauto'); ?></span>								
        </label>

						
		<label class="jws-checkbox">
			<input name="user_type" value="business_seller" type="radio"<?php echo esc_attr($check2); ?>> 
            <span class="checkmark"></span>	
            <span><?php echo esc_html__('Business seller','idealauto'); ?></span>
        </label>
					

		</div>
    
    </div>

	<?php

	?>

	<div>
		<?php wp_nonce_field( 'update_account_details' ); ?>
        <button type="submit" class="elementor-button btn-main jws-submit-car"><span><?php esc_attr_e( 'Save changes', 'idealauto' ); ?></span></button>
		<input type="hidden" name="action" value="update_account_details" />
	</div>
    <div class="jws-notes"></div>
	<?php do_action( 'jws_edit_account_form_end' ); ?>
</form>