 <?php 
    wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
    wp_enqueue_style('lightgallery'); 
    wp_enqueue_script('lightgallery-all');
    $userdata = get_userdata( $author );
    $author_logo = get_user_meta( $author, 'dealer-avatar', true ); 
    $author_gallery = get_user_meta( $author, 'dealer_images', true );  
    $author_about = get_user_meta( $author, 'description', true ); 
    $ratings = jws_get_dealer_marks($author); 
    global $jws_option;
 ?>
 <div class="dealer-public">
 <div class="row">
    <div class="col-xl-12">
     <div class="dealer-images"> 
          <?php if(!empty($author_logo)) {
                $img = jws_getImageBySize(array('attach_id' => $author_logo, 'thumb_size' => 'thumbnail', 'class' => 'dealer-logo'));
                echo ''.$img['thumbnail'];
          } ?>
            <div>
             <h2 class="dealer-name"><?php echo jws_display_user_name($author); ?></h2>
            
            <div class="jws-star-rating">
                <?php if (!empty($ratings['average'])):  dealer_review_html($ratings); endif; ?>
                <a href="#tabs-nav" class="write-review" data-tabs="tab3"> <?php echo esc_html__('Write a review','idealauto'); ?> </a>
            </div>
            
            </div>
      </div>
    </div>
    <div class="col-xl-8 col-lg-12 col-12"> 
      <?php if(!empty($author_gallery)) : ?>   
      <div class="dealer-gallery">
      <div class="images-wap">
        <div class="images-slider">
            <?php
                foreach($author_gallery as $value) {
                    $img = jws_getImageBySize(array('attach_id' => $value, 'thumb_size' => 'jws-car-author-size', 'class' => 'dealer-images-item'));
                    $imagefull = wp_get_attachment_image_src($value, 'full');
                    echo '<div class="slider-item slick-slide" data-src="'.$imagefull[0].'">'.$img['thumbnail'].'</div>';
                }
            ?>
        </div>
    </div>
    <div class="thumbnail-slider">
        <?php
            foreach($author_gallery as $value) {
                $img = jws_getImageBySize(array('attach_id' => $value, 'thumb_size' => 'jws-car-author-size', 'class' => 'dealer-gallery-item'));
                echo '<div class="slider-item slick-slide">'.$img['thumbnail'].'</div>';
            }
        ?>
    </div>
    </div>
    <script>
     jQuery(document).ready(function ($) {
        $('.images-slider').lightGallery({
                thumbnail:true
          });
        var $carousel = $('.images-slider');
          $carousel
            .slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              prevArrow: '<span class="jws-carousel-btn prev-item"><i class="jws-icon-arrow_carrot-left"></i></span>',
              nextArrow: '<span class="jws-carousel-btn next-item "><i class="jws-icon-arrow_carrot-right"></i></span>',
              adaptiveHeight: true,
              asNavFor: '.thumbnail-slider'
            })
            
          $('.thumbnail-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.images-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            arrows: false,
          });
        });
    </script>
      <?php endif; ?> 
      <?php if(!empty($author_about)) : ?>
      <div class="dealer-about">
            <h4><?php echo esc_html__('About this Dealer','idealauto'); ?></h4>
            <?php echo ''.$author_about; ?>
      </div>   
      <?php endif; ?>

    <div id="tabs-nav" class="dealer-tabs car-tabs">
    <div class="tabs-nav">
        <li data-tabs="tab1" class="tab1 active"><?php echo esc_html__(' Dealer\'s Inventory','idealauto'); ?></li>
        <li data-tabs="tab2" class="tab2"><?php echo esc_html__('Dealer Reviews','idealauto'); ?></li>
        <li data-tabs="tab3" class="tab3"><?php echo esc_html__('Write a review ','idealauto'); ?></li>
    </div>
    <div class="dealer-content">
    <div class="tabcontent accordion-active" id="tab1">
        <h3 class="tab-heading"><?php echo esc_html__(' Dealer\'s Inventory','idealauto'); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
        <div class="cars-Tabs-panel">
        <?php get_template_part( 'template-parts/content/author/dealer-cars' ); ?>
        </div>
    </div>
     <div class="tabcontent" id="tab2">
        <h3 class="tab-heading"><?php echo esc_html__('Dealer Reviews','idealauto'); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
        <div class="cars-Tabs-panel">
        <?php get_template_part( 'template-parts/content/author/dealer-review' ); ?>  
        </div>
    </div>
     <div class="tabcontent" id="tab3">
        <h3 class="tab-heading"><?php echo esc_html__('Write a review ','idealauto'); ?><span class="jws-icon-arrow_carrot-down"></span></h3>
        <div class="cars-Tabs-panel">
        <?php get_template_part( 'template-parts/content/author/dealer-form-review' ); ?>  
        </div>
    </div>
    </div>
    </div>
        </div>
    
        <div class="col-xl-4 col-lg-12 col-12 dealer-sidebar">
            <div class="jws_sticky_move">
                <?php get_template_part( 'template-parts/content/author/sidebar' ); ?> 
            </div>     
        </div>
    </div>
    <?php 
    if(isset($jws_option['select-content-before-footer-author-detail']) && !empty($jws_option['select-content-before-footer-author-detail'])) { ?>
        <div class="content-before-footer">
            <?php echo do_shortcode('[hf_template id="'.$jws_option['select-content-before-footer-author-detail'].'"]'); ?> 
        </div> 
   <?php }
?>
</div>