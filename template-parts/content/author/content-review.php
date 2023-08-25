<?php

$post_id = get_the_ID();

/*Get user added review*/
$user_added = get_post_meta($post_id, 'dealer_review_added_by', true);

$rate1 = get_post_meta($post_id, 'jws_rate', true);

$number_of_rates = 3;
$average = 0;
$average = $rate1;



$user_avatar = get_user_meta( $user_added, 'dealer-avatar', true ); 
?>
<li class="comment">
<div class="comment-body">
    <div class="comment-avatar">
        <div class="comment-avatar">
            <?php if(!empty($user_avatar)) {
                $img = jws_getImageBySize(array('attach_id' => $user_avatar, 'thumb_size' => 'thumbnail', 'class' => 'user-comment'));
                echo ''.$img['thumbnail'];
          } ?>
        </div>
    </div>
    <div class="comment-info">
        <div class="comment-header-info">
            <h5 class="title-review"><?php the_title(); ?></h5>  
            <?php if(!empty($rate1)): $average_width = round((($average * 100) / 5), 1) . '%'; ?>
               
    				<div class="average">
    					<div class="jws-star-rating">
    						<div class="inner">
    							<div class="jws-star-rating-upper" style="width:<?php echo esc_attr($average_width); ?>"></div>
    							<div class="jws-star-rating-lower"></div>
    						</div>
    					</div>
    				</div>
    		
                <?php endif; ?>
            <div class="author-info">    
                <span class="comment-date"><?php the_date(); ?></span>
                <h4 class="comment-author"><?php echo esc_html__('By: ','idealauto').get_the_author_meta('display_name',$user_added); ?></h4>
            </div>
        </div>
        
        <?php the_content(); ?>
    </div>
</div>
</li>
