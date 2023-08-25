<?php

	/*Reviews*/
	$reviews = jws_get_dealer_reviews($author);

	if($reviews->have_posts()): ?>
		<h3 class="dealer-review-title"><?php esc_html_e('Reviews', 'idealauto'); ?><span>(<?php echo esc_attr($reviews->found_posts); ?>)</span></h3>
			<div class="comments-area" id="jws-dealer-reviews-units">
                <div class="comment_top ">
                    <ol class="comment-list"> 
        				<?php while($reviews->have_posts()): $reviews->the_post();
        					get_template_part( 'template-parts/content/author/content','review' ); 
        				endwhile; ?>
                    </ol>
                </div>
			</div>

		<?php if($reviews->found_posts > 6): ?>
			<div class="jws-load-more-dealer-reviews">
				<a href="#" data-user="<?php echo esc_attr($author); ?>" data-offset="6"><span><?php esc_html_e('Show more', 'idealauto'); ?></span></a>
			</div>
		<?php endif;

	else: ?>
		<h4 class="jws_empty_reviews"><?php esc_html_e('Be the first to write a review!', 'idealauto'); ?></h4>
<?php endif; 






