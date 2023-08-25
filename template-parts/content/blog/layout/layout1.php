<?php 
    global $jws_option;
    $comments_number = get_comments_number();
     $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta( get_the_ID(), 'blog_gallery', true );
    $image_size = (isset($jws_option['blog_imagesize']) && !empty($jws_option['blog_imagesize'])) ? $jws_option['blog_imagesize'] : 'full'; 
    $attach_id = get_post_thumbnail_id();
    
?>
<div class="jws_post_wap<?php if($attach_id == '-1' || !$attach_id) echo esc_attr(' post-no-thumbnail'); ?>">
    <div class="jws_post_image">
        <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>
        <div class="jws_post_image_inner<?php if(!empty($gallery)) echo esc_attr(' post-image-slider'); ?>">
        <?php 
            
           echo !empty($gallery) ? '<div class="slick-slide">' : '<div>';
               if (function_exists('jws_getImageBySize')) {
                     $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $image_size, 'class' => 'attachment-large wp-post-image'));
                     echo ''.(!empty($img['thumbnail'])) ? '<a href="'.get_the_permalink().'">'.$img['thumbnail'].'</a>' : '';
               } 
           echo '</div>'; 
          if(!empty($gallery)) {
               foreach($gallery as $image_id) {
                    echo '<div class="slick-slide">'; 
                        if (function_exists('jws_getImageBySize')) {
                             $img = jws_getImageBySize(array('attach_id' => $image_id, 'thumb_size' => $image_size, 'class' => 'blog-gallery'));
                             echo ''.(!empty($img['thumbnail'])) ? ''.$img['thumbnail'] : '';
                        }
                    echo '</div>';      
               } 
          }
         
      ?>
    </div>
    </div>
    <div class="jws_post_content">
           <div class="entry-category"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></div> 
           <h3 class="entry-title"><a class="hover_line" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
           <div class="jws_post_excerpt">
               <?php  echo wp_trim_words( get_the_excerpt(), 50, '...' );?>
           </div>  
            <a href="<?php the_permalink(); ?>" class="jws-post-readmore">
                <?php echo esc_html__('Read more','idealauto'); ?><span class="jws-icon-arrow_right"></span>
            </a>
    </div>
</div>

  
