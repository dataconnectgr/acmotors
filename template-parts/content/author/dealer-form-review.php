<?php
global $author , $jws_option;


if ( is_user_logged_in() ):

    $user_current = wp_get_current_user();
    $user_current_id = $user_current->ID;
    $user_reviews = jws_get_user_reviews( $user_current_id, $author );

    if ( intval( $user_reviews->found_posts ) > 0 ): ?>

        <div class="jws_user_added_review heading-font"><?php esc_html_e( 'You have already added review. If you leave another one review, previous will be deleted.', 'idealauto' ) ?></div>

    <?php endif; ?>

    <form action="" method="post" id="jws_submit_review">
        <input type="hidden" name="jws_user_on" value="<?php echo intval( $author ); ?>"/>
        <div class="jws-write-dealer-review clearfix">
                 <div class="jws-star-rating" data-width="0">
                    <div class="inner">
                        <div class="jws-star-rating-upper"></div>
                        <div class="jws-star-rating-lower"></div>
                    </div>
                    <span><strong>0</strong> <?php esc_html_e( 'out of', 'idealauto' ); ?> 5</span>
                    <input type="hidden" name="jws_rate"/>
                </div>
                <div class="form-group">
                    <h4><?php esc_html_e( 'Title', 'idealauto' ); ?></h4>
                    <input type="text" name="jws_title"
                           placeholder="<?php esc_attr_e( 'About your experience in a few words', 'idealauto' ) ?>"
                           required/>
                </div>
                <div class="form-group">
                    <h4><?php esc_html_e( 'Your Review', 'idealauto' ); ?></h4>
                    <textarea name="jws_content"
                              placeholder="<?php esc_attr_e( 'Share the details of your experience and help other car buyers make the right choice.', 'idealauto' ) ?>"></textarea>
                </div>
                <div class="jws-checker-required">
                    <label>
                        <input type="checkbox" name="jws_required"/>
                        <span class="jws-label"><?php esc_html_e( 'I am not a dealer, and I am not employed by a dealership.', 'idealauto' ); ?></span>
                    </label>
                </div>
    
            <div class="clearfix"></div>
            <a href="#" class="btn-main elementor-button button"><span><?php esc_html_e( 'Submit review', 'idealauto' ); ?></span></a>
            <div id="write-review-message"></div>
        </div>
    </form>

    <script>
        jQuery(document).ready(function () {
            var $ = jQuery;
            $('.jws-write-dealer-review .jws-star-rating .inner').on('mousemove', function (event) {
                var parentOffset = $(this).offset().left;
                var parentWidth = $(this).width();
                var currentMousePos = parseInt(event.pageX);
                currentMousePos = parentWidth - ((parentOffset + parentWidth) - currentMousePos);
                var jwsCurrent = (currentMousePos * 100) / parentWidth;

                var ratingChange = $(this).closest('.jws-star-rating').find('span strong');

                if (jwsCurrent <= 20) {
                    $(this).find('.jws-star-rating-upper').css('width', '20%');
                    ratingChange.text('1');
                } else if (jwsCurrent > 20 && jwsCurrent <= 40) {
                    $(this).find('.jws-star-rating-upper').css('width', '40%');
                    ratingChange.text('2');
                } else if (jwsCurrent > 40 && jwsCurrent <= 60) {
                    $(this).find('.jws-star-rating-upper').css('width', '60%');
                    ratingChange.text('3');
                } else if (jwsCurrent > 60 && jwsCurrent <= 80) {
                    $(this).find('.jws-star-rating-upper').css('width', '80%');
                    ratingChange.text('4');
                } else if (jwsCurrent > 80) {
                    $(this).find('.jws-star-rating-upper').css('width', '100%');
                    ratingChange.text('5');
                } else {
                    $(this).find('.jws-star-rating-upper').css('width', '0%');
                }
            });

            $('.jws-write-dealer-review .jws-star-rating .inner').on('click', function (event) {
                var parentOffset = $(this).offset().left;
                var parentWidth = $(this).width();
                var currentMousePos = parseInt(event.pageX);
                currentMousePos = parentWidth - ((parentOffset + parentWidth) - currentMousePos);
                var jwsCurrent = (currentMousePos * 100) / parentWidth;

                if (jwsCurrent <= 20) {
                    $(this).find('.jws-star-rating-upper').css('width', '20%');
                    $(this).closest('.jws-star-rating').attr('data-width', '1');
                    $(this).closest('.jws-star-rating').find('input').val(1);
                } else if (jwsCurrent > 20 && jwsCurrent <= 40) {
                    $(this).find('.jws-star-rating-upper').css('width', '40%');
                    $(this).closest('.jws-star-rating').attr('data-width', '2');
                    $(this).closest('.jws-star-rating').find('input').val(2);
                } else if (jwsCurrent > 40 && jwsCurrent <= 60) {
                    $(this).find('.jws-star-rating-upper').css('width', '60%');
                    $(this).closest('.jws-star-rating').attr('data-width', '3');
                    $(this).closest('.jws-star-rating').find('input').val(3);
                } else if (jwsCurrent > 60 && jwsCurrent <= 80) {
                    $(this).find('.jws-star-rating-upper').css('width', '80%');
                    $(this).closest('.jws-star-rating').attr('data-width', '4');
                    $(this).closest('.jws-star-rating').find('input').val(4);
                } else if (jwsCurrent > 80) {
                    $(this).find('.jws-star-rating-upper').css('width', '100%');
                    $(this).closest('.jws-star-rating').attr('data-width', '5');
                    $(this).closest('.jws-star-rating').find('input').val(5);
                } else {
                    $(this).find('.jws-star-rating-upper').css('width', '0%');
                    $(this).closest('.jws-star-rating').attr('data-width', '0');
                    $(this).closest('.jws-star-rating').find('input').val(0);
                }
            });

            $('.jws-write-dealer-review .jws-star-rating .inner').on('mouseleave', function (event) {
                var jwsChangeWidth = $(this).closest('.jws-star-rating').attr('data-width');
                var ratingChange = $(this).closest('.jws-star-rating').find('span strong');
                ratingChange.text(jwsChangeWidth);
                jwsChangeWidth = (jwsChangeWidth * 100) / 5;
                $(this).find('.jws-star-rating-upper').css('width', jwsChangeWidth + '%');
            });

            $('#jws_submit_review input[type="checkbox"]').on('click', function () {
                var checked = $(this).prop('checked');
                if (checked) {
                    $('#jws_submit_review .button').removeClass('disabled');
                } else {
                    $('#jws_submit_review .button').addClass('disabled');
                }
            })

        });
    </script>

<?php else: ?>

    <h5 class="jws-login-review-leave"><a
                href="<?php echo (isset($jws_option['dealer_login_form']) && !empty($jws_option['dealer_login_form'])) ? get_page_link($jws_option['dealer_login_form']) : '#'; ?>"><?php esc_html_e( 'Login', 'idealauto' ); ?></a> <?php esc_html_e( 'to leave a review', 'idealauto' ); ?>
    </h5>

<?php endif; ?>