<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $jws_option;

wp_enqueue_script('jws-car-submit');
wp_enqueue_script( 'jquery-ui-droppable' );
wp_enqueue_script( 'locationpicker' );

$car_edit = false;

if (!empty($_GET['edit-car']) and $_GET['edit-car']) {
    $car_edit = true;
}

$restricted = false;

if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $restrictions = jws_get_post_limits($user_id);
    $note_login = '';
    
}else {
    if(isset($jws_option['jws_add_car_login_form']) && !empty($jws_option['jws_add_car_login_form'])) { 
       $note_login = sprintf(
            '<div class="before-login">'.__('You can also','idealauto').' %s '.__('You can also','idealauto').'</div>',
            '<a href="'.get_page_link($jws_option['jws_add_car_login_form'] ).'">'.__('Log in or Register','idealauto').'</a>'
        );

    }
    
    $restrictions = jws_get_post_limits('');
} 


$vars = array();

$menu_list = array(
    'add_car_step1' => esc_html__('Car Attributes','idealauto'),
    'add_car_step2' => esc_html__('Upload media','idealauto'),
    'add_car_step3' => esc_html__('Additional Information','idealauto'),
    'add_car_step4' => esc_html__('Enter Dealer Note','idealauto'),
    'add_car_step5' => esc_html__('Set your asking price','idealauto'),
);

if ($car_edit){ 

    if (!empty($_GET['car-id'])) {
        $car_id = intval($_GET['car-id']);
        $car_id = intval($_GET['car-id']);

        $car_user = get_post($car_id);
        if(empty($car_user)) {
          echo '<h4>' . esc_html__('Vehicle not found.', 'idealauto') . '</h4>';
          return false;  
        }
        if (intval($user_id) != intval($car_user->post_author)) {
            echo '<h4>' . esc_html__('You are not the owner of this vehicle.', 'idealauto') . '</h4>';
            return false;
        }
    } else {
        echo '<h4>' . esc_html__('No vehicle to edit.', 'idealauto') . '</h4>';
        return false;
    }

    $vars = array(
        'id' => $car_id
    );
} ?>
<div class="jws_add_car_page">
    <div class="row">
        <div class="col-xl-3 col-lg-3">
            <div class="ac-step-tab jws_sticky_move jws_sticky_move_change">
                <ul class="ct_ul_ol">
                <?php 
                   $i = 1; 
                   foreach($menu_list as $key => $value) {
                        $active = ($key == 'add_car_step1') ? 'active' : '';
                        echo '<li> <a href="javascript:void(0)" class="'.$active.'" data-id="'.$key.'"><span class="step-item-number">'.$i.'</span>'.$value.'</a></li>';
                        $i++;
                   } 
                ?>
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9">
    	<div class="jws_add_car_form jws_add_car_form_<?php echo esc_attr($car_edit); ?>">
            <?php
            echo ''.$note_login;
    		if(!empty($user->ID)):
    		$limits = jws_get_post_limits($user->ID);
            ?>
    		<div class="jws-posts-available-number">
    			<?php esc_html_e('Slots available', 'idealauto'); ?>: <span><?php echo esc_attr($limits['posts']); ?></span>
    		</div>
    
            <?php endif; ?>
    		
    		<form method="post" action="" enctype="multipart/form-data" id="jws_car_form">
                <div class="ac-step-progressbar">
                    <span></span>
                </div>
    			<?php 
    				if ($car_edit){ 
    			?>
    					<input name="jws_action_car_id" value="<?php echo esc_attr($car_id);?>" type="hidden">
    			<?php	
    				} else {
    					$action = 'jws_add_car';
    				}
    			?>
    			<input name="jws_car_form_action" class="form-control" value="jws_add_car" type="hidden">
    			<?php 
    			if( isset($user_id) ){
    				wp_nonce_field( 'jws-car-form', 'jws-car-form-nonce-field' ); 
    			}?>
    			<?php 
    			global $jws_option; 
                    get_template_part( 'template-parts/content/car-submit/step/step-1' , null , $vars );
                    get_template_part( 'template-parts/content/car-submit/step/step-2' );
                    get_template_part( 'template-parts/content/car-submit/step/step-3' );
                    get_template_part( 'template-parts/content/car-submit/step/step-4' );
                    get_template_part( 'template-parts/content/car-submit/step/step-5' );
    
    
    			?>
    		
				<div class="form-group">
					<div id="car_form_captcha" class="g-recaptcha" 
						<?php
						if ( ! isset( $user_id ) ) {
							?>
							style="display:none"<?php } ?>></div>
				</div>
    			
    		</form>
    	</div>
        </div>
    </div>
</div>
