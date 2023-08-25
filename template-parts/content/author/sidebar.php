<div class="section section1">
  <h3><?php echo esc_html__('Contact Info','idealauto'); ?></h3>  
  <?php 
        $long = get_the_author_meta('dealer_location',$author);
        $phone = get_the_author_meta('dealer_phone',$author);
        $mail = get_the_author_meta('email',$author);
        $banner = get_the_author_meta('banner',$author); 
        $banner_url = get_the_author_meta('banner_url',$author);

        $opentime = array(
                'monday' => esc_html__("Monday","idealauto"),
                'tuesday' => esc_html__("Tuesday","idealauto"),
                'wednesday' => esc_html__("Wednesday","idealauto"),
                'thursday' => esc_html__("Thursday","idealauto"),
                'friday' => esc_html__("Friday","idealauto"),
                'saturday' => esc_html__("Saturday","idealauto"),
                'sunday' => esc_html__("Sunday","idealauto"),
         );
     
   ?>
  <ul class="ct_ul_ol contact-info">
    <?php if(!empty($long)) : ?>
    <li class="dealer-mail"><label><?php echo esc_html__('ADDRESS','idealauto'); ?></label><i class="fas fa-map-marker-alt"></i><span><?php echo esc_html($long['address']); ?></span></li>
    <?php endif; ?>
    <?php if(!empty($phone)) : ?>
    <li class="dealer-phone"><label><?php echo esc_html__('PHONE','idealauto'); ?></label><i class="fas fa-phone-alt"></i><span><?php echo esc_html($phone); ?></span></li>
    <?php endif; ?>
    <?php if(!empty($mail)) : ?>
    <li><label><?php echo esc_html__('EMAIL','idealauto'); ?></label><i class="fas fa-envelope"></i><span><?php echo esc_html($mail); ?></span></li>
    <?php endif; ?>
  </ul>
  <?php if(!empty($opentime)): ?> 
  <h4 class="opentime-title"><?php echo esc_html__('Hours Of Operation','idealauto'); ?></h4>
  <ul class="ct_ul_ol opentime-list">
        <?php 
      
            foreach($opentime as $key => $value) {
                ?>
                    <li><span class="label"><?php echo esc_html($value); ?></span><span class="value"><?php echo get_the_author_meta($key,$author); ?></span></li>
                <?php
            }
        ?>
  </ul>
  <?php endif; ?> 
  <h4 class="social-title"><?php echo esc_html__('Social Network','idealauto'); ?></h4>
  <ul class="ct_ul_ol dealer-social">
    <?php
        $facebook = get_the_author_meta('dealer_facebook',$author);
        $twitter = get_the_author_meta('dealer_twitter',$author);
        $whatsapp = get_the_author_meta('dealer_whatsapp',$author);
        $instagram = get_the_author_meta('dealer_instagram',$author);
        if(!empty($facebook)) echo '<li><a href="'.esc_url($facebook).'"><i class="fab fa-facebook-f"></i></a></li>';
        if(!empty($twitter)) echo '<li><a href="'.esc_url($twitter).'"><i class="fab fa-twitter"></i></a></li>';
        if(!empty($whatsapp)) echo '<li><a href="'.esc_url($whatsapp).'"><i class="fab fa-whatsapp"></i></a></li>';
        if(!empty($instagram)) echo '<li><a href="'.esc_url($instagram).'"><i class="fab fa-instagram"></i></a></li>';
     ?>
</ul>
   
</div>

<div class="section section2">
    <?php get_template_part( 'template-parts/content/author/contact-form' ); ?>  
</div>

<div class="section section3">
    <?php if(!empty($banner)) : $img_atts = wp_get_attachment_image_src($banner, 'full');   $url = !empty($banner_url)? $banner_url : '';  ?>
        <a href="<?php echo esc_url($url); ?>">
            <img src="<?php echo esc_url($img_atts[0]); ?>" alt="<?php echo esc_attr__('banner dealer','idealauto'); ?>" />
        </a>
    <?php endif; ?>
</div>